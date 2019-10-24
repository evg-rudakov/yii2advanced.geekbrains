<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%task}}`.
 */
class m190914_103534_add_project_id_column_to_task_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('task', 'project_id', $this->integer());
        $this->addForeignKey(
            'fk_task_it_project_id',
            'task',
            'project_id',
            'project',
            'id',
            'CASCADE',
            'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_task_it_project_id', 'task');
        $this->dropColumn('task', 'project_id');
    }
}
