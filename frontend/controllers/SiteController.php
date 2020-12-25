<?php
namespace frontend\controllers;

use frontend\models\forms\LoanCalcForm;
use frontend\models\forms\PaymentScheduleForm;
use frontend\models\helpers\ErrorMsgHelper;
use Yii;
use yii\web\ConflictHttpException;
use yii\web\Controller;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * @return array|null
     * @throws ConflictHttpException
     */
    public function actionCalc(){
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new LoanCalcForm();
        if($model->load(Yii::$app->request->post(),'') && $model->validate()){
            if($model->calc() && !$model->hasErrors()){
                return [
                    'html' => $this->renderPartial('_payments', ['payments' => $model->getPayments()]),
                    'loan_id' => $model->getLoanId()
                ];
            }
        }
        throw new ConflictHttpException(ErrorMsgHelper::getErrorMsg($model));
    }

    /**
     * Displays result.
     *
     * @return mixed
     */
    public function actionResult()
    {
        return $this->render('result');
    }

    /**
     * @return array|null
     * @throws ConflictHttpException
     */
    public function actionSchedule(){
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new PaymentScheduleForm();
        if($model->load(Yii::$app->request->post(),'') && $model->validate()){
            if($model->isLoanExist()){
                return [
                    'html' => $this->renderPartial('_payments', ['payments' => $model->getPayments()]),
                    'loan_id' => $model->loan_id
                ];
            }
        }

        throw new ConflictHttpException(ErrorMsgHelper::getErrorMsg($model));
    }
}
