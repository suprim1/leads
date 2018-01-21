<?php

$params = require(__DIR__ . '/params.php');

/**
 * Application configuration shared by all test types
 */
return [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'ru',
    'sourceLanguage' => 'ru',
    'modules' => [
        'user' => [
            'class' => 'app\modules\user\UserModule',
        ],
        'login' => [
            'class' => 'app\modules\login\LoginModule',
        ],
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'sSDsddsdSD4_sdCVmKlLfser2#',
            'baseUrl' => '',
        ],
        'errorHandler' => [
            'errorAction' => 'comment/default/error',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\modules\login\models\Users',
            'enableAutoLogin' => true,
            'loginUrl' => ['/login'],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
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
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'db' => require(__DIR__ . '/db.php'),
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '/' => 'login/default/index',
                'logout' => 'login/default/logout',
                'activation' => 'login/default/activation'
            ],
        ],
        'sentry' => [
            'class' => 'mito\sentry\Component',
            'dsn' => 'https://7a42076f97a84ff78efeb2e06cf15c7b:f4349579e15041f7bb68b0c20bd22b1c@sentry.io/247983', // private DSN
            'enabled' => YII_ENV_DEV ? false : true,
        //'enabled' => true,
        //'environment' => 'staging', // if not set, the default is `production`
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'mito\sentry\Target',
                    'levels' => ['error', 'warning'],
                    'except' => [
                        'yii\web\HttpException:404',
                    ],
                ],
            ],
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            //'viewPath' => '@common/mail',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.yandex.ru',
                'username' => 'suprim1@yandex.ru',
                'password' => 'Cthdfr_12',
                'port' => '465',
                'encryption' => 'ssl', // у яндекса SSL
            ],
            'useFileTransport' => false, // будем отправлять реальные сообщения, а не в файл
        ],
    ],
    'params' => $params,
];
