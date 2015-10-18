<?php
$config = [
    'id' => 'kalpok',
    'language' => 'fa',
    'bootstrap' => ['log'],
    'name' => 'kalpol cms',
    'sourceLanguage' => 'en',
    'timeZone' => 'Asia/Tehran',
    'basePath' => dirname(__DIR__),
    'aliases' => [
        '@config' => '@app/config',
        '@themes' => '@app/themes',
        '@modules' => '@app/modules'
    ],
    'controllerMap' => [
        'file' => 'kalpok\file\controllers\FileController'
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'i18n' => [
            'class' => 'kalpok\i18n\I18N'
        ],
        'formatter' => [
            'class' => 'kalpok\i18n\Formatter',
            'dateFormat' => 'php:d F Y',
            'datetimeFormat' => 'php:d F Y | H:i',
        ],
        'date' => [
            'class' => 'kalpok\components\Date',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'setting' => [
            'class' => 'kalpok\components\Setting',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['superuser', 'editor', 'operator'],
            // 'cache' => 'cache'
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
        'user' => [
            'enableAutoLogin' => true,
            'loginUrl' => ['/user/auth/login'],
            'identityClass' => 'app\modules\user\common\components\UserIdentity'
        ],
        'db' => require(__DIR__ . '/local/db.php')
    ],
    'params' => [
        'adminEmail' => 'admin@example.com',
    ]
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
