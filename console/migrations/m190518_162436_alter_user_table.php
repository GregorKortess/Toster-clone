<?php

use yii\db\Migration;

/**
 * Class m190518_162436_alter_user_table
 */
class m190518_162436_alter_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function Up()
    {
        $this->addColumn('{{%user}}','contribution',$this->integer()->defaultValue(0));
        $this->addColumn('{{%user}}','questions',$this->integer()->defaultValue(0));
        $this->addColumn('{{%user}}','answers',$this->integer()->defaultValue(0));
        $this->addColumn('{{%user}}','solutions',$this->integer()->defaultValue(0));
        $this->addColumn('{{%user}}','nickname',$this->string(70));
        $this->addColumn('{{%user}}','picture',$this->string());
        $this->addColumn('{{%user}}','firstName',$this->string(30));
        $this->addColumn('{{%user}}','lastName',$this->string(30));
        $this->addColumn('{{%user}}','about',$this->text());
        $this->addColumn('{{%user}}','userStatus',$this->text());

    }

    /**
     * {@inheritdoc}
     */
    public function Down()
    {
        $this->dropColumn('{{%user}}','contribution');
        $this->dropColumn('{{%user}}','questions');
        $this->dropColumn('{{%user}}','answers');
        $this->dropColumn('{{%user}}','solutions');
        $this->dropColumn('{{%user}}','nickname');
        $this->dropColumn('{{%user}}','picture');
        $this->dropColumn('{{%user}}','firstName');
        $this->dropColumn('{{%user}}','lastName');
        $this->dropColumn('{{%user}}','about');
        $this->dropColumn('{{%user}}','userStatus');








    }


}
