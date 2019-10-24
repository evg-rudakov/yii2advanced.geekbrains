<?php
/**
 * Created by PhpStorm.
 * User: evg
 * Date: 14/09/2019
 * Time: 12:07
 */

namespace frontend\modules\api\controllers;


use common\models\Task;
use common\models\User;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;
use yii\web\ForbiddenHttpException;

class UserController extends ActiveController
{

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
    public $modelClass = User::class;

    public function actionMe()
    {
        return ['me' => \Yii::$app->user->identity];
    }

    public function checkAccess($action, $model = null, $params = [])
    {
        if ($action === 'view') {
            if ($model->id !== \Yii::$app->user->id) {
                throw new ForbiddenHttpException('Нельзя другого пользователя смотреть');
            }
        }
    }


    public function actionTasks($id)
    {
        return Task::find()->where(['author_id'=>$id])->asArray()->all();
    }
}