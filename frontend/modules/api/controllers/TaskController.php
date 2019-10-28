<?php
/**
 * Created by PhpStorm.
 * User: evg
 * Date: 12/09/2019
 * Time: 15:14
 */
namespace frontend\modules\api\controllers;

use common\models\Task;
use yii\rest\ActiveController;

class TaskController extends ActiveController
{
    public $modelClass = Task::class;
}