<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'language' => strpos($_COOKIE['language'], 'kz-KZ') ? 'kz-KZ' : 'ru-RU', // Устанавливаем язык из куки или по умолчанию русский
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'authManager' => [
            'class' => 'yii\rbac\DbManager', // or use your own RBAC implementation
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'CtpIQgV053bKxqAz4eRYBpr2sjk_zuJv',
            'enableCsrfValidation' => false, // CSRF защита включена
        ],
        'session' => [
            'class' => 'yii\web\Session',
            'timeout' => 3600,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true, // Убедитесь, что эта опция включена
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            // send all mails to a file by default.
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
                'site/submit-changed-city' => 'site/submit-changed-city',
                'site/index' => 'site/index',
                'site/login' => 'site/login',
                'site/register' => 'site/register',
                'catalog/man/<id:\d+>' => 'catalog/man',
                'catalog/women/<id:\d+>' => 'catalog/women',
                'catalog/product/<id:\d+>' => 'catalog/product',
                'user/order/update/<id:\d+>' => 'user/orders-update',
                'user/order/create' => 'user/orders-create',
                'user/profile/update' => 'user/profile-update',
                'site/change-language' => 'site/change-language',
                // Другие правила маршрутизации
            ],
        ],
        'i18n' => [
            'translations' => [
                'app' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/langs', // Путь к папке с файлами перевода
                    'fileMap' => [
                        'app' => 'app.php',
                    ],
                ],
            ],
        ],
        'language' => isset($_COOKIE['language']) ? $_COOKIE['language'] : 'ru-RU', // Устанавливаем язык из куки или по умолчанию русский
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
