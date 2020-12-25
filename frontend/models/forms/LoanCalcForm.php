<?php
namespace frontend\models\forms;

use common\models\Loan;
use common\models\PaymentSchedule;
use frontend\models\helpers\ErrorMsgHelper;
use yii\base\Model;

class LoanCalcForm extends Model
{
    public $start_date;
    public $amount;
    public $term;
    public $percent;
    private $payments;
    private $overpaymentAmount;
    private $loanId;
    public function rules()
    {
        return [
            [['start_date', 'amount', 'term', 'percent'], 'required']
        ];
    }

    /**
     * @link formula https://www.raiffeisen.ru/wiki/kak-rasschitat-annuitetnyj-platezh/
     */
    public function calc(){
        $monthlyPercent          = round($this->percent/100/12, 2);
        $monthlyPaymentAmount    = $this->getMonthlyAmount($monthlyPercent);
        $this->overpaymentAmount = $monthlyPaymentAmount * $this->term - $this->amount;
        $this->loanId = $this->saveLoan();
        $this->payments = $this->savePayments($monthlyPaymentAmount);
        return true;
    }

    private function getMonthlyAmount($monthlyPercent){
        return round($this->amount *
            $monthlyPercent * pow((1 + $monthlyPercent), $this->term)/(pow((1+$monthlyPercent),$this->term)-1));
    }

    public function saveLoan(){
        $model = new Loan();
        $model->start_date = $this->start_date;
        $model->term = $this->term;
        $model->amount = $this->amount;
        $model->percent = $this->percent;
        $model->overpayment_amount = $this->overpaymentAmount;
        if(!$model->save()){
            $this->addError('amount', ErrorMsgHelper::getErrorMsg($model));
            return false;
        }
        return $model->id;
    }

    public function savePayments($monthlyAmount){
        $batchValues = $this->prepareData($monthlyAmount);
        \Yii::$app->db->createCommand()
            ->batchInsert(
                PaymentSchedule::tableName(),
                [
                    'loan_id', 'serial', 'payment_date', 'monthly_amount',
                    'percent_amount', 'main_amount', 'principal_debt', 'created_at', 'updated_at'],
                $batchValues)->execute();
        return $batchValues;
    }

    private function prepareData($monthlyAmount){
        $batchValues = [];
        $currentDate = date('Y-m-d H:i:s');
        for($month = 0; $month < $this->term; $month++){
            $batchValues[$month]['loan_id']        = $this->loanId;
            $batchValues[$month]['serial']         = $month+1;
            $batchValues[$month]['created_at']     = $currentDate;
            $batchValues[$month]['updated_at']     = $currentDate;
            $batchValues[$month]['payment_date']   = $this->getMonth($month);
            if($month == $this->term-1){
                $batchValues[$month]['main_amount']
                    = $this->amount - $batchValues[$month-1]['main_amount'] * ($month);
                $batchValues[$month]['percent_amount'] =
                    $this->overpaymentAmount - $batchValues[$month-1]['percent_amount'] * ($month);
                $batchValues[$month]['monthly_amount'] =
                    $batchValues[$month]['main_amount'] + $batchValues[$month]['percent_amount'];
                $batchValues[$month]['principal_debt'] =
                    $batchValues[$month-1]['principal_debt'] - $batchValues[$month-1]['main_amount'];
            }else{
                $batchValues[$month]['main_amount']    = $this->getMainAmount();
                $batchValues[$month]['percent_amount'] = $monthlyAmount-$batchValues[$month]['main_amount'];
                $batchValues[$month]['monthly_amount'] = $monthlyAmount;
                $batchValues[$month]['principal_debt'] = $this->getPrincipalAmount($batchValues[$month]['main_amount'], $month);
            }
        }
        return $batchValues;
    }

    private function getMainAmount(){
        return round($this->amount / $this->term);
    }

    private function getPrincipalAmount($mainAmount, $month){
        return $this->amount - $mainAmount * $month;
    }

    private function getMonth($increment){
        return date('Y-m-d',strtotime($this->start_date.' +'.$increment.' Months'));
    }

    public function getPayments(){
        return $this->payments;
    }

    public function getLoanId(){
        return $this->loanId;
    }
}