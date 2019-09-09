<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%chat_log}}`.
 */
class m190907_154624_create_chat_log_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%chat_log}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(),
            'message' => $this->string(),
            'created_at' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%chat_log}}');
    }
}
