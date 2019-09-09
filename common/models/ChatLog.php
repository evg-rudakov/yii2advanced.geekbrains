<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "chat_log".
 *
 * @property int $id
 * @property string $username
 * @property string $message
 * @property string $created_at
 */
class ChatLog extends \yii\db\ActiveRecord
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
            ['created_at', 'safe'],
            [['username', 'message', 'created_at'], 'string', 'max' => 255],
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

    public static function saveLog(string $msg)
    {
        try {
            $model = new self(json_decode($msg, true));
            $model->created_at = time();
            $model->save();
        } catch (\Throwable $exception) {
            Yii::error($exception->getMessage());
        }

    }
}
