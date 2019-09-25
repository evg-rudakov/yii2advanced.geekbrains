<?php
/**
 * Created by PhpStorm.
 * User: evg
 * Date: 25/09/2019
 * Time: 18:41
 */

namespace common\components\behaviors;

use common\models\ChatLog;
use common\models\Project;
use common\models\Task;
use yii\db\ActiveRecord;
use yii\db\Exception;

/**
 * Class ChatLogBehavior
 * @package common\components\behaviors
 */
class ChatLogBehavior extends \yii\base\Behavior
{
    /**
     * @return array
     */
    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'saveChatLog'
        ];
    }

    public $attributes;
    public $value;
    public $qweqweqweqwe;

    /**
     * @param $event
     * @throws Exception
     */
    public function saveChatLog($event)
    {

        var_dump($this->attributes);
        var_dump($this->qweqweqweqwe);
        var_dump($this->value);
        die();

        $model = $event->sender;
        $chatLog = new ChatLog();
        $message = '';
        if ($model instanceof Task) {
            $chatLog->task_id = $model->id;
            if (isset($model->project_id)) {
                $chatLog->project_id = $model->project_id;
            }
            $message = "Пользователь {$model->author->username} создал новую задачу {$model->name}";
        } elseif ($model instanceof Project) {
            $chatLog->project_id = $model->id;
            $message = "Пользователь {$model->author->username} создал новый проект {$model->name}";

        }
        $chatLog->username = \Yii::$app->user->identity->username;
        $chatLog->message = $message;

        if (!$chatLog->save()) {
            \Yii::error(json_encode($chatLog->errors));
            throw new Exception('save-error');

        }
    }
}