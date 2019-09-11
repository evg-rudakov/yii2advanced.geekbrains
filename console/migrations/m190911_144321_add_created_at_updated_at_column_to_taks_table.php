<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%taks}}`.
 */
class m190911_144321_add_created_at_updated_at_column_to_taks_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('task', 'created_at', $this->integer());
        $this->addColumn('task', 'updated_at', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('task', 'created_at');
        $this->dropColumn('task', 'updated_at');
    }
}
