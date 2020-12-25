<?php

use yii\db\Migration;

/**
 * Class m201224_134548_create_table_loans
 */
class m201224_134548_create_table_loans extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('loans', [
            'id' => $this->primaryKey(),
            'start_date' => $this->date()->notNull(),
            'amount'     => $this->money()->notNull(),
            'term'       => $this->integer()->notNull(),
            'percent'    => $this->integer()->notNull(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime()
        ]);

        $this->createTable('payment_schedule',[
            'id' => $this->primaryKey(),
            'loan_id' => $this->integer()->notNull(),
            'serial'    => $this->integer()->comment('Номер платежа'),
            'payment_date' => $this->date()->comment('Дата платежа'),
            'monthly_amount' => $this->money(12,2)->comment('Ежемесячный платеж'),
            'percent_amount' => $this->money(12,2)->comment('Сумму погашаемых процентов'),
            'main_amount'    => $this->money(12,2)->comment('Сумму погашаемого основного долга'),
            'principal_debt' => $this->money(12,2)->comment('Остаток основного долга'),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('loans');
        $this->dropTable('payment_schedule');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201224_134548_create_table_loans cannot be reverted.\n";

        return false;
    }
    */
}
