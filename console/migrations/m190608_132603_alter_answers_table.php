<?php

use yii\db\Migration;

/**
 * Class m190608_132603_alter_answers_table
 */
class m190608_132603_alter_answers_table extends Migration
{

    public function Up()
    {
        $this->addColumn('{{%answers}}','status',$this->integer(1)->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function Down()
    {
        $this->dropColumn('{{%answers}}','status');
    }

}
