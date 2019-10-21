<?php

use yii\db\Migration;

/**
 * Class m191017_175154_alter_created_at_column_at_chat_log_table
 */
class m191017_175154_alter_created_at_column_at_chat_log_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('chat_log','created_at', $this->integer());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('chat_log','created_at', $this->string());
    }

}
