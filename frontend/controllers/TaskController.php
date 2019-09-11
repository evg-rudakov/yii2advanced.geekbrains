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

class TaskController extends ActiveController
{

    public $modelClass = Task::class;


    public function actionRandom($count)
    {
        for ($i = 0; $i < $count; $i++) {
            $task = new Task();
            $task->description = \Yii::$app->security->generateRandomString(3);
            $task->author_id = 2;
            $task->name = \Yii::$app->security->generateRandomString(3);
            $task->status_id = 1;
            $task->priority_id = 1;
            $task->save();

        }

    }
}