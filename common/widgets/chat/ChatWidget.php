<?php
/**
 * Created by PhpStorm.
 * User: evg
 * Date: 31/10/2019
 * Time: 19:16
 */

namespace common\widgets\chat;


use yii\base\Widget;

class ChatWidget extends Widget
{
    public $username;

    public $task_id;
    public $project_id;

    public function init()
    {
        parent::init();
        ChatAsset::register($this->view);
        if (\Yii::$app->user->isGuest) {
            $this->username = 'guest' . time();
        } else {
            $this->username = \Yii::$app->user->identity->username;
        }

    }

    public function run()
    {
        return $this->render('index');
    }

}