<?php
/**
 * Created by Artem Manchenkov
 * manchenkov@reg.ru
 * 2019
 */

return [
    'rules' => [
        [
            'class' => \yii\rest\UrlRule::class,
            'controller' => 'api/user',
            'pluralize' => true,
            'extraPatterns' => [
                // actions
                'POST sign-up' => 'sign-up',
                'POST sign-in' => 'sign-in',
                'GET me' => 'me',
            ],
        ],
        [
            'class' => \yii\rest\UrlRule::class,
            'controller' => 'api/task',
            'pluralize' => true,
        ],

    ],
];

