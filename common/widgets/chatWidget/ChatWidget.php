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
        ChatAsset::register($this->view);
        parent::init();
    }

    /**
     * @return string
     */
    public function run()
    {
        if (\Yii::$app->user->isGuest) {
            $username = 'guest' . time();
        } else {
            $username = \Yii::$app->user->identity->username;
        }
        return $this->render('index', [
            'username' => $username]);
    }

}