<?php

use yii\db\Migration;

/**
 * Class m191031_163459_update_chat_log_table
 */
class m191031_163459_update_chat_log_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('chat_log', 'project_id', $this->integer());
        $this->addColumn('chat_log', 'task_id', $this->integer());
        $this->addColumn('chat_log', 'type', $this->integer());
        $this->addForeignKey('fk_chat_log_task_id', 'chat_log', 'task_id', 'task', 'id');
        $this->addForeignKey('fk_chat_log_project_id', 'chat_log', 'project_id', 'project', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_chat_log_task_id', 'chat_log');
        $this->dropForeignKey('fk_chat_log_project_id', 'chat_log');
        $this->dropColumn('chat_log', 'project_id');
        $this->dropColumn('chat_log', 'task_id');
        $this->dropColumn('chat_log', 'type');
    }

}
