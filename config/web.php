<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'pt-BR',
    'sourceLanguage' => 'en-US',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'Z-eYOAoHZuN3xA2Di8_vUAS3pWWlncVg',
            'enableCookieValidation' => true,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        'authManager'  => [
            'class' => 'yii\rbac\DbManager',
        ],
        'i18n' => [
            'translations' => [
                'main*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages',
                    'sourceLanguage' => 'en-US',
                    'fileMap' => [
                        'main' => 'main.php',
                        'app/error' => 'error.php',
                    ],
                ],
            ],
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@Da/User/resources/views' => '@app/views/user'
                ]
            ]
        ],
        'session' => [
            'class' => \yii\web\Session::class,
            'name' => 'app'
        ],
    ],
    'modules' => [
        'gridview' => [
            'class' => '\kartik\grid\Module',
        ],
        'gridviewKrajee' =>  [
            'class' => '\kartik\grid\Module',
            // your other grid module settings
        ],
        'datecontrol' => [
            'class' => '\kartik\datecontrol\Module',
        ],
        'user' => [
            'class' => \Da\User\Module::class,
            'viewPath' => '@app/views/user',
            'allowAccountDelete' => true,
            'enableRegistration' => false,
            'administratorPermissionName' => 'user-management',
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '*'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '*'],
    ];
}

return $config;
