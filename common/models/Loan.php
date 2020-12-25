<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "loans".
 *
 * @property int $id
 * @property string $start_date
 * @property float $amount
 * @property float $overpayment_amount
 * @property int $term
 * @property int $percent
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Loan extends \yii\db\ActiveRecord
{

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
    public static function tableName()
    {
        return 'loans';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['start_date', 'amount', 'term', 'percent'], 'required'],
            [['start_date', 'created_at', 'updated_at'], 'safe'],
            [['amount', 'overpayment_amount'], 'number'],
            [['term', 'percent'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'start_date' => 'Start Date',
            'amount' => 'Amount',
            'overpayment_amount' => 'Overpayment Amount',
            'term' => 'Term',
            'percent' => 'Percent',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
