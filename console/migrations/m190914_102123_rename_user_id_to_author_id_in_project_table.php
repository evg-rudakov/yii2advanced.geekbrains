<?php

use yii\db\Migration;

/**
 * Class m190914_102123_rename_user_id_to_author_id_in_project_table
 */
class m190914_102123_rename_user_id_to_author_id_in_project_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('project', 'user_id', 'author_id');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->renameColumn('project', 'author_id', 'user_id');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190914_102123_rename_user_id_to_author_id_in_project_table cannot be reverted.\n";

        return false;
    }
    */
}
