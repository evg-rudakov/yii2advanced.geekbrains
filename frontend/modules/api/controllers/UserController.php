<?php
/**
 * Created by PhpStorm.
 * User: evg
 * Date: 14/09/2019
 * Time: 12:07
 */

namespace frontend\modules\api\controllers;


use common\models\Task;
use common\models\TaskStatus;
use common\models\User;
use yii\data\ActiveDataProvider;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;

class UserController extends ActiveController
{
    public $modelClass = User::class;

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        //подключаем авторизацию через HttpBearerAuth
        //каждый запрос к этому контроллеру будет фильтроваться через это поведение
        //authenticator - имеет больший приоритет чем ACF
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::class,
            //нужно исключить action которые используются в accessFilter ACF
            'except' => ['create']
        ];
        return $behaviors;
    }
//
//
//
    public function actionMe()
    {
        return \Yii::$app->user->identity;
    }
//
    public function actionTasks($id = null)
    {
        if (is_null($id)) {
            $id = \Yii::$app->user->id;
        }

        $dataProvider = new ActiveDataProvider([
            'query' => Task::find()->where(['author_id' => $id])
        ]);

        return $dataProvider;
//        $tasks = Task::findAll(['author_id' => $id]);
//        return $tasks;
    }




}