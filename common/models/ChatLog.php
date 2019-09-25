<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "chat_log".
 *
 * @property int $id
 * @property int $project_id
 * @property int $task_id
 * @property string $username
 * @property string $message
 * @property string $created_at
 * @mixin TimestampBehavior
 */
class ChatLog extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    public static function tableName()
    {
        return 'chat_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['project_id', 'task_id'], 'integer'],
            ['created_at', 'safe'],
            [['username', 'message'], 'string', 'max' => 255],
        ];
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => false,
                'value' => time(),
            ],
        ];
    }



    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'message' => 'Message',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @param array $msg
     * @return bool
     */
    public static function saveLog(array $msg)
    {
        try {
            if (empty($msg['username'])) {

                return true;
            }
            $model = new ChatLog();
            $model->username = $msg['username'];
            $model->message = $msg['message'];
            $model->project_id = $msg['project_id'] ?? null;
            $model->task_id = $msg['task_id'] ?? null;
            return $model->save();
        } catch (\Throwable $exception) {
            Yii::error($exception->getMessage());
            return false;
        }
    }
    public function asJson()
    {
        return json_encode($this->toArray());
    }

    public function fields()
    {
        return array_merge(parent::fields(), [
            'created_datetime'=> function(){
            return Yii::$app->formatter->asDatetime($this->created_at);
            }
        ]);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Task::class, ['id' => 'task_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::class, ['id' => 'project_id']);
    }

    public static function fromJson(string $json)
    {
        $json = json_decode($json, true);
        return new static($json);
    }

}
