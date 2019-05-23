<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%questions}}`.
 */
class m190523_173206_create_questions_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function Up()
    {
        $this->createTable('{{%questions}}', [
            'id' => $this->primaryKey(),
            'user_id'=> $this->integer()->notNull(),
            'filename' => $this->string(),
            'question' => $this->string()->notNull(),
            'description' => $this->text()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'difficulty' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function Down()
    {
        $this->dropTable('{{%questions}}');
    }
}
