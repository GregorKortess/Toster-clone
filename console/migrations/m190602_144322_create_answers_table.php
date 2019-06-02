<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%answers}}`.
 */
class m190602_144322_create_answers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function Up()
    {
        $this->createTable('{{%answers}}', [
            'id' => $this->primaryKey(),
            'author_id' => $this->integer(),
            'question_id' => $this->integer(),
            'status' => $this->integer(1)->defaultValue(0),
            'text' => $this->string(),
            'picture' => $this->string(),
            'created_at' => $this->integer(),

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function Down()
    {
        $this->dropTable('{{%answers}}');
    }
}
