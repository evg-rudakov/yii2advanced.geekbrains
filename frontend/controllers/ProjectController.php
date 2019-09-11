<?php
/**
 * Created by PhpStorm.
 * User: evg
 * Date: 11/09/2019
 * Time: 15:28
 */

namespace frontend\controllers;


use common\models\Task;
use yii\rest\ActiveController;

class ProjectController extends ActiveController
{
    public $modelClass = Task::class;

}