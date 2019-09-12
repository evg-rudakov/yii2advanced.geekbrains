<?php
/**
 * Created by PhpStorm.
 * User: evg
 * Date: 11/09/2019
 * Time: 15:28
 */

namespace frontend\controllers;


use common\models\Task;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;

class TaskController extends ActiveController
{
    public $modelClass = Task::class;


    public function actionRandom($count=5)
    {
        $output = [];
        $errors = [];

        \Yii::$app->db->beginTransaction();
        try {
            for ($i = 0; $i < $count; $i++) {
                $task = new Task();
                $task->description = \Yii::$app->security->generateRandomString(3);
                $task->author_id = 2;
                $task->name = \Yii::$app->security->generateRandomString(3);

                if ($i == 2) {
                    $task->name = '';
                }
                $task->status_id = 1;
                $task->priority_id = 1;
                if ($task->save()) {
                    $output[$i] = $task->attributes;
                } else {
                    $errors[$i] = $task->errors;
                }
            }

            $result = empty($errors);
            if ($result === true) {
                \Yii::$app->db->transaction->commit();
            } else {
                \Yii::$app->db->transaction->rollBack();
            }

            return ['result' => empty($errors), 'errors' => $errors, 'output' => $output];
        } catch (\Throwable $exception) {
            \Yii::$app->db->transaction->rollBack();
            return ['result' => false, 'error_message' => $exception->getMessage()];
        }

    }

    public function actionIndex()
    {
        return new ActiveDataProvider([
            'query' => Task::find(),
            'pagination' => [
                'pageSize' => 100,
            ],
        ]);
    }
}