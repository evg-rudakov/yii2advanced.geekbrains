<?php

use yii\db\Migration;

/**
 * Class m190921_110036_update_chat_log_table
 */
class m190921_110036_update_chat_log_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('chat_log', 'project_id', $this->integer());
        $this->addColumn('chat_log', 'task_id', $this->integer());
        $this->alterColumn('chat_log', 'created_at', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('chat_log', 'project_id');
        $this->dropColumn('chat_log', 'task_id');
        $this->alterColumn('chat_log', 'created_at', $this->string());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190921_110036_update_chat_log_table cannot be reverted.\n";

        return false;
    }
    */
}
