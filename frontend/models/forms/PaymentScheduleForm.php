<?php
namespace frontend\models\forms;


use common\models\Loan;
use common\models\PaymentSchedule;
use yii\base\Model;

class PaymentScheduleForm extends Model
{
    public $loan_id;
    private $payments;

    public function rules()
    {
        return [
            ['loan_id', 'required']
        ];
    }

    public function isLoanExist(){
        $loan = Loan::findOne($this->loan_id);
        if(!$loan){
            $this->addError('loan_id', 'Не найдено записей по ID: ' . $this->loan_id);
            return false;
        }
        $this->payments = PaymentSchedule::find()->where(['loan_id' => $this->loan_id])->asArray()->all();
        return true;
    }

    public function getPayments(){
        return $this->payments;
    }
}