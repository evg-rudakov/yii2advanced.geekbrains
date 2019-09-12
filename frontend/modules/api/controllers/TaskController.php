<?php
/**
 * Created by PhpStorm.
 * User: evg
 * Date: 12/09/2019
 * Time: 15:14
 */
namespace frontend\modules\api\controllers;

use yii\db\Exception;
use yii\filters\auth\CompositeAuth;
use yii\filters\ContentNegotiator;
use yii\filters\RateLimiter;
use yii\filters\VerbFilter;
use yii\rest\Controller;
use yii\web\Response;

class TaskController extends Controller
{

    public function behaviors()
    {
        return [
            'contentNegotiator' => [
                'class' => ContentNegotiator::className(),
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                    'application/xml' => Response::FORMAT_XML,
                ],
            ],
            'verbFilter' => [
                'class' => VerbFilter::className(),
                'actions' => $this->verbs(),
            ],
            'authenticator' => [
                'class' => CompositeAuth::className(),
            ],

            //огранитель запросв
            'rateLimiter' => [
                'class' => RateLimiter::className(),
            ],
        ];
    }
    public function actionIndex()
    {
        throw new Exception('ewqweqeqweqw');

    }
}