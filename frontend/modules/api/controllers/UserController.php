<?php
/**
 * Created by PhpStorm.
 * User: evg
 * Date: 14/09/2019
 * Time: 12:07
 */

namespace frontend\modules\api\controllers;


use common\models\User;
use yii\rest\ActiveController;
use yii\rest\Controller;

class UserController extends ActiveController
{

    public $modelClass = User::class;
    public function singUp()
    {
        $a=1;

    }

    public function actions()
    {
        $actions = parent::actions();

        $actions['create']['singUp'] = [$this, 'singUp'];

        return $actions;
    }


}