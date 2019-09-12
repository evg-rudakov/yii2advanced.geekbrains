<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "project_status".
 *
 * @property int $id
 * @property string $name
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Project[] $projects
 */
class ProjectStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    const IN_PROGRESS_ID = 1;
    const IN_PLANNING_ID = 2;
    const FINISHED_ID = 3;
    public static function tableName()
    {
        return 'project_status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjects()
    {
        return $this->hasMany(Project::className(), ['project_status_id' => 'id']);
    }

    public static function getProjectStatusName(){
        return [
          self::IN_PROGRESS_ID => 'В работе',
          self::IN_PLANNING_ID => 'Планируется',
          self::FINISHED_ID => 'Завершен'
        ];
    }


}
