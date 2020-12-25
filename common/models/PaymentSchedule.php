<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "payment_schedule".
 *
 * @property int $id
 * @property int $loan_id
 * @property int|null $serial Номер платежа
 * @property string|null $payment_date Дата платежа
 * @property float|null $monthly_amount Ежемесячный платеж
 * @property float|null $percent_amount Сумму погашаемых процентов
 * @property float|null $main_amount Сумму погашаемого основного долга
 * @property float|null $principal_debt Остаток основного долга
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class PaymentSchedule extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payment_schedule';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'value' => function(){
                    return date('Y-m-d H:i:s');
                }
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['loan_id'], 'required'],
            [['loan_id', 'serial'], 'integer'],
            [['payment_date', 'created_at', 'updated_at'], 'safe'],
            [['monthly_amount', 'percent_amount', 'main_amount', 'principal_debt'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'loan_id' => 'Loan ID',
            'serial' => 'Serial',
            'payment_date' => 'Payment Date',
            'monthly_amount' => 'Monthly Amount',
            'percent_amount' => 'Percent Amount',
            'main_amount' => 'Main Amount',
            'principal_debt' => 'Principal Debt',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
