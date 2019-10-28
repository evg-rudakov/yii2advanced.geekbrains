<?php
/**
 * Created by PhpStorm.
 * User: evg
 * Date: 12/09/2019
 * Time: 15:14
 */
namespace frontend\modules\api\controllers;

use common\models\Task;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;
use yii\web\ForbiddenHttpException;

class TaskController extends ActiveController
{
    public $modelClass = Task::class;

    public function checkAccess($action, $model = null, $params = [])
    {
        if ($action === 'view') {
            if ($model->author_id !== \Yii::$app->user->id) {
                throw new ForbiddenHttpException('Нельзя смотреть задачи где вы не являетесь автором');
            }
        }
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::class,
            //нужно исключить action которые используются в accessFilter ACF
//            'except' => ['create']
        ];

        return $behaviors;

    }


    public function actionRandom($count)
    {
        return ['count' => $count];
    }
}