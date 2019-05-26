<?php

use yii\db\Migration;

/**
 * Class m190526_120906_alter_table_questions
 */
class m190526_120906_alter_table_questions extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function Up()
    {
        $this->addColumn('{{questions}}','tag',$this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{questions}}','tag');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190526_120906_alter_table_questions cannot be reverted.\n";

        return false;
    }
    */
}
