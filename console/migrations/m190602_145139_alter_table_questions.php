<?php

use yii\db\Migration;

/**
 * Class m190602_145139_alter_table_questions
 */
class m190602_145139_alter_table_questions extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function Up()
    {
        $this->addColumn('{{%questions}}','status',$this->integer(1)->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function Down()
    {
        $this->dropColumn('{{%questions}}','status');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190602_145139_alter_table_questions cannot be reverted.\n";

        return false;
    }
    */
}
