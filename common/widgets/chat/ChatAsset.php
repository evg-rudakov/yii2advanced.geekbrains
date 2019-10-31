<?php
/**
 * Created by PhpStorm.
 * User: evg
 * Date: 31/10/2019
 * Time: 19:16
 */

namespace common\widgets\chat;

use yii\web\AssetBundle;
use yii\web\YiiAsset;

class ChatAsset extends AssetBundle
{
    public $sourcePath = (__DIR__ . '/assets');

    public $js = ['js/chat.js'];

    public $css = ['css/chat.css'];

    public $depends = [
        YiiAsset::class
    ];
}