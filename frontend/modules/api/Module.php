<?php
/**
 * Created by PhpStorm.
 * User: evg
 * Date: 12/09/2019
 * Time: 15:13
 */

namespace frontend\modules\api;

use yii\web\ErrorHandler;
use yii\web\GroupUrlRule;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'frontend\modules\api\controllers';
}