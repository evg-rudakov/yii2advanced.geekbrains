<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "task".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $author_id
 * @property int $status_id
 * @property int $priority_id
 * @property int $created_at
 * @property int $updated_at
 * @property int $project_id
 *
 * @property Comment[] $comments
 * @property Tag[] $tags
 * @property TaskPriority $priority
 * @property User $author
 * @property Project $project
 * @property TaskStatus $status
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description', 'author_id', 'status_id', 'priority_id'], 'required'],
            [['description'], 'string'],
            [['author_id', 'status_id', 'priority_id', 'project_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['priority_id'], 'exist', 'skipOnError' => true, 'targetClass' => TaskPriority::class, 'targetAttribute' => ['priority_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => TaskStatus::class, 'targetAttribute' => ['status_id' => 'id']],
            [['created_at', 'updated_at'], 'safe']
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
            'description' => 'Description',
            'author_id' => 'Author ID',
            'status_id' => 'Status ID',
            'priority_id' => 'Priority ID',
            'project_id' => 'Project ID',
        ];
    }

    public function behaviors()
    {
        return [
            'timestampBehavior' => [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                    'value' => time(),
                ],
            ],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::class, ['task_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTags()
    {
        return $this->hasMany(Tag::class, ['task_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPriority()
    {
        return $this->hasOne(TaskPriority::class, ['id' => 'priority_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::class, ['id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(TaskStatus::class, ['id' => 'status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::class, ['id' => 'project_id']);
    }

    public function fields()
    {
        $parentFields =  parent::fields();
        $modelFields = [
            'created_at'=> function() {
                if (isset($this->created_at)){
                    return Yii::$app->formatter->asDatetime($this->created_at);
                }

                return null;
            },
            'priority_id' => function () {
                return TaskPriority::getPriorityName()[$this->priority_id];
            },
            'status_id' => function () {
                return $this->status->name;
            }
        ];

        return array_merge($parentFields, $modelFields);
    }

    public function extraFields()
    {
        return [
            'author' => function () {
                $this->author;
            }
        ];
    }


}
