<?php
/**
 * Created by PhpStorm.
 * User: evg
 * Date: 04/11/2019
 * Time: 14:23
 */


namespace common\components\behaviors;
use common\components\interfaces\ChatLoggable;
use common\models\Project;
use common\models\Task;
use yii\base\Behavior;
use yii\base\InvalidArgumentException;
use yii\db\ActiveRecord;

/**
 * Class ChatLogBehavior
 * @property Task|Project $owner
 * @package common\components\behaviors
 */
class ChatLogBehavior extends Behavior
{
    public $attributes;
    public $value;


    public function events()
    {
       return [
          ActiveRecord::EVENT_AFTER_INSERT => 'saveChatLog',
       ];
    }


    /**
     * @param $event
     */
    public function saveChatLog($event)
    {
        $model = $this->owner;

        return $model->saveChatLog();

    }


}