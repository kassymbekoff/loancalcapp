<?php

use yii\db\Migration;

/**
 * Class m201225_110737_add_column_overpayment_amount
 */
class m201225_110737_add_column_overpayment_amount extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('loans', 'overpayment_amount',
            $this->money(12,2)->notNull()->after('amount'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('loans', 'overpayment_amount');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201225_110737_add_column_overpayment_amount cannot be reverted.\n";

        return false;
    }
    */
}
