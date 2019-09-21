<?php

use yii\db\Migration;

/**
 * Class m190921_115040_update_task_table
 */
class m190921_115040_update_task_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('task','executor_id', $this->integer());
        $this->addColumn('task', 'accountable_id', $this->integer());
        $this->addForeignKey('fk-task-user-executor_id', 'task', 'executor_id','user', 'id');
        $this->addForeignKey('fk-task-user-accountable_id', 'task', 'accountable_id','user', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-task-user-executor_id', 'task');
        $this->dropForeignKey('fk-task-user-accountable_id', 'task');
        $this->dropColumn('task','executor_id');
        $this->dropColumn('task', 'accountable_id');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190921_115040_update_task_table cannot be reverted.\n";

        return false;
    }
    */
}
