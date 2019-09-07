<?php
/**
 * Created by PhpStorm.
 * User: evg
 * Date: 07/09/2019
 * Time: 11:01
 */

namespace frontend\controllers;


use yii\web\Controller;

class ChatController extends Controller
{
    public function actionIndex() {
        return $this->render('index');
    }

}