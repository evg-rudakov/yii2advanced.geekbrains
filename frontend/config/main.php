<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

$config =  [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => [
        'api',
        'log'
    ],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'parsers' => [
                'application/json' => \yii\web\JsonParser::class,
                'charset' => 'UTF-8'
            ],
        ],
        'formatter' => [
            'dateFormat' => 'php:d.m.Y',
            'datetimeFormat' => 'php:d.m.Y H:i:s',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
//            'enableStrictParsing' => true,
            'rules' => [
                '/'=> 'project/index',
                 [
                    'class' => \yii\rest\UrlRule::class,
                    'controller' => 'api/user',
                    'pluralize' => true,
                    'extraPatterns' => [
                        // actions
                        'GET me' => 'me',

                        'GET <id>/tasks' => 'tasks',
                        'GET tasks' => 'tasks',
                    ],
                ],
                [
                    'class' => \yii\rest\UrlRule::class,
                    'controller' => 'api/task',
                    'pluralize' => true,
                ],
            ],
        ],
//        'view'=>[
//            'theme' => [
//                'basePath' => '@app/themes/first',  //базовая директория со стилизованными ресурсами (CSS, JS, изображения)
//                'baseUrl' => '@web/themes/first',   // базовый адрес доступа к стилизованным ресурсам.
//                'pathMap' => [  //правила замены файлов view
//                    '@app/views/user' => '@app/themes/first/user',
//                    '@app/modules' => '@app/themes/first/modules',
//                    '@app/widgets' => '@app/themes/first/widgets',
//                ],
//            ]
//        ],

    ],
    'modules' => [
        'api' => [
            'class' => \frontend\modules\api\Module::class
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['*']
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['*']
    ];

    $config['components']['assetManager']['forceCopy'] = true;

}

return $config;


