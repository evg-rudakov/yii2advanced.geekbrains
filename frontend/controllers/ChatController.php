<?php
/**
 * Created by PhpStorm.
 * User: evg
 * Date: 07/09/2019
 * Time: 18:25
 */

namespace frontend\controllers;

use Yii;
use yii\web\Controller;

class ChatController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}