<?php
/**
 * Created by PhpStorm.
 * User: evg
 * Date: 12/09/2019
 * Time: 15:13
 */

namespace frontend\modules\api;

use yii\web\ErrorHandler;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'frontend\modules\api\controllers';

    public function init()
    {
        parent::init();

        \Yii::configure($this, [
            'components' => [
                'response' => [
                    'class' => \yii\web\Response::class,
                    'format' => \yii\web\Response::FORMAT_JSON,
                    'formatters' => [
                        \yii\web\Response::FORMAT_JSON => [
                            'class' => \yii\web\JsonResponseFormatter::class,
                            'prettyPrint' => YII_DEBUG,
                            'encodeOptions' => JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE,
                        ],
                    ],
                    'on beforeSend' => function ($event) {
                        /** @var \yii\web\Response $response */
                        $response = $event->sender;
                        $response->format = \yii\web\Response::FORMAT_JSON;
                    },
                ],
            ],
        ]);

        /** @var ErrorHandler $handler */
        $handler = $this->get('response');
        \Yii::$app->set('response', $handler);

    }

}