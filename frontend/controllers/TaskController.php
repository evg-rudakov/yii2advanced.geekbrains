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
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;

class TaskController extends ActiveController
{
    public $modelClass = Task::class;

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        //подключаем авторизацию через HttpBearerAuth
        //каждый запрос к этому контроллеру будет фильтроваться через это поведение
        //authenticator - имеет больший приоритет чем ACF
        $behaviors['authenticator'] = [
//            'class' => QueryParamAuth::class,
            'class' => HttpBearerAuth::class,
//            'class' => HttpBasicAuth::::class //логин-пароль
//            'tokenParam' => 'q',
            //нужно исключить action которые используются в accessFilter ACF
//            'except' => ['loign']
        ];
        return $behaviors;
    }

    public function actions()
    {
        $actions = parent::actions();

        // отключить действия "delete" и "create"
        unset($actions['delete'], $actions['create']);

        // настроить подготовку провайдера данных с помощью метода "prepareDataProvider()"
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];

        return $actions;
    }



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

    public function prepareDataProvider()
    {
        return new ActiveDataProvider([
            'query' => Task::find(),
            'pagination' => [
                'pageSize' => 100,
                'pageSizeParam'=>'count'
            ],
        ]);
    }
}