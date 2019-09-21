<?php
/**
 * Created by PhpStorm.
 * User: evg
 * Date: 21/09/2019
 * Time: 11:27
 */

namespace common\components\chatWidget;


use yii\bootstrap\BootstrapAsset;
use yii\web\AssetBundle;

class ChatAsset extends AssetBundle
{
    public $sourcePath = '@common/components/chatWidget/assets';
    public $js = ['js/chat.js'];

    public $depends = [
        BootstrapAsset::class
    ];
}