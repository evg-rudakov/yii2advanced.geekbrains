<?php
/**
 * Created by PhpStorm.
 * User: evg
 * Date: 03/09/2019
 * Time: 15:28
 */

namespace frontend\controllers;


use yii\web\Controller;

class HelloController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}