<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tags}}`.
 */
class m190525_140929_create_tags_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function Up()
    {
        $this->createTable('{{%tags}}', [
            'id' => $this->primaryKey(),
            'picture' => $this->string()->notNull(),
            'name' => $this->string(50)->notNull(),
            'description' => $this->text()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function Down()
    {
        $this->dropTable('{{%tags}}');
    }
}
