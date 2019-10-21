<?php

use yii\db\Migration;

/**
 * Class m190911_120908_table
 */
class m190911_120908_create_task_priority_status_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%task}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'description' => $this->text()->notNull(),
            'author_id' => $this->integer()->notNull(),
            'status_id' => $this->Integer()->notNull(),
            'priority_id' => $this->Integer()->notNull(),
        ]);

        $this->createTable('{{%task_status}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
        ]);

        $this->addForeignKey(
            'fk_task_status_id',
            'task',
            'status_id',
            'task_status',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->createTable('{{%tag}}', [
            'id' => $this->primaryKey(),
            'task_id' => $this->integer()->notNull(),
            'tag_name' => $this->string(255)->notNull(),
        ]);

        $this->addForeignKey(
            'fk_tag_task_id',
            'tag',
            'task_id',
            'task',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->createTable('{{%comment}}', [
            'id' => $this->primaryKey(),
            'task_id' => $this->integer()->notNull(),
            'text' => $this->text()->notNull(),
        ]);

        $this->addForeignKey(
            'fk_comment_task_id',
            'comment',
            'task_id',
            'task',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->createTable('{{%task_priority}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
        ]);

        $this->addForeignKey(
            'fk_task_priority_id',
            'task',
            'priority_id',
            'task_priority',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_task_priority_id', 'task');
        $this->dropForeignKey('fk_comment_task_id', 'comment');
        $this->dropForeignKey('fk_tag_task_id', 'tag');
        $this->dropForeignKey('fk_task_status_id', 'task');

        $this->dropTable('fk_task_priority_id');
        $this->dropTable('fk_comment_task_id');
        $this->dropTable('fk_tag_task_id');
        $this->dropTable('fk_task_status_id');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190911_120908_table cannot be reverted.\n";

        return false;
    }
    */
}
