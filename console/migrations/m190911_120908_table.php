<?php

use yii\db\Migration;

/**
 * Class m190911_120908_table
 */
class m190911_120908_table extends Migration
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

        $this->createTable('{{%status_task}}', [
            'id' => $this->primaryKey(),
            'status_name' => $this->string(255)->notNull(),
        ]);

        $this->addForeignKey(
            'fk_task_status_id',
            'task',
            'status_id',
            'status_task',
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
            'comment_text' => $this->text()->notNull(),
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

        $this->createTable('{{%priority_task}}', [
            'id' => $this->primaryKey(),
            'priority_name' => $this->string(255)->notNull(),
        ]);

        $this->addForeignKey(
            'fk_task_priority_id',
            'task',
            'priority_id',
            'priority_task',
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
        echo "m190911_120908_table cannot be reverted.\n";

        return false;
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
