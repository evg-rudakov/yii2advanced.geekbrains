<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "chat_log".
 *
 * @property int $id
 * @property int $task_id
 * @property int $project_id
 * @property int $type
 * @property string $username
 * @property string $message
 * @property string $created_at
 */
class ChatLog extends \yii\db\ActiveRecord
{

    const TYPE_HELLO_MESSAGE = 1;
    const TYPE_CHAT_MESSAGE = 2;
    const TYPE_SHOW_HISTORY_MESSAGE = 3;
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
            ['created_at', 'safe'],
            [['username', 'message'], 'string', 'max' => 255],
            [['task_id', 'project_id', 'type'], 'integer']
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

    public static function saveLog(array $msg)
    {
        try {
            $model = new self([
                'username' => $msg['username'],
                'message'=>$msg['message'],
            ]);
            $model->project_id = $msg['project_id'] ?? null;
            $model->task_id = $msg['task_id'] ?? null;
            $model->type = $msg['type'] ?? null;

            $model->created_at = time();
            $model->save();

        } catch (\Throwable $exception) {
            Yii::error($exception->getMessage());
        }
    }

    public function asJson()
    {
        return json_encode($this->toArray());
    }

    public function fields()
    {
        return array_merge(parent::fields(), [
            'created_datetime'=> function()  {
                return Yii::$app->formatter->asDatetime($this->created_at);
            }
        ]);
    }

    /**
     * @param $data
     * @return \yii\db\ActiveQuery
     */
    public static function findChatMessages($data)
    {
        $project_id = $data['project_id'] ?? null;
        $task_id = $data['task_id'] ?? null;

        $query = ChatLog::find()->andFilterWhere([
            'project_id' => $project_id,
            'task_id' => $task_id,
            'type' => ChatLog::TYPE_CHAT_MESSAGE
        ])
            ->orderBy('created_at ASC')
            ->limit(100);

        return $query;
    }
}
