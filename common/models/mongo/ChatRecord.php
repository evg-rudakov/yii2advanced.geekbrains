<?php
/**
 * Created by PhpStorm.
 * User: evg
 * Date: 07/09/2019
 * Time: 13:04
 */

namespace common\models\mongo;

use yii\behaviors\TimestampBehavior;
use yii\mongodb\ActiveRecord;

/** Class ChatRecord
 * @package common/models/mongo/ChatRecord
 *
 * @property string $message
 * @property string $user_name
 * @property integer $created_at
 *
 */
class ChatRecord extends ActiveRecord
{

    /**
     * @return string the name of the index associated with this ActiveRecord class.
     */
    public static function collectionName()
    {
        return 'chat_record';
    }

    /**
     * @return array list of attribute names.
     */
    public function attributes()
    {
        return ['_id', 'user_name', 'message', 'created_at'];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                    'value' => time(),
                ],
            ],
        ];
    }

    public static function saveRecord($message)
    {
        $message = json_encode($message);
        $record = new self();
        $record->message = $message['message'] ?? '';
        $record->user_name = $message['user_name'] ?? '';
        $record->save();
        }

}