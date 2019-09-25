<?php
/**
 * Created by PhpStorm.
 * User: evg
 * Date: 21/09/2019
 * Time: 11:21
 */

namespace common\widgets\chatWidget;

use yii\base\Widget;

/**
 * Class ChatWidget
 * @package common\widgets\chatWidget
 */
class ChatWidget extends Widget
{
    public $project_id = null;
    public $task_id = null;

    /**
     * @throws \yii\base\InvalidConfigException
     */
    public function init()
    {
        if (\Yii::$app->user->isGuest) {
            $username = 'guest' . time();
        } else {
            $username = \Yii::$app->user->identity->username;
        }

        ChatAsset::register($this->view);
        $this->view->registerMetaTag(['name'=>'chat-widget-project-id', 'content'=>$this->project_id]);
        $this->view->registerMetaTag(['name'=>'chat-widget-task-id', 'content'=>$this->task_id]);
        $this->view->registerMetaTag(['name'=>'chat-widget-username', 'content'=>$username]);

        parent::init();
    }

    /**
     * @return string
     */
    public function run()
    {

        return $this->render('index');
    }

}