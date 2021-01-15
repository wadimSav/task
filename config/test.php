<?php
$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/test_db.php';

/**
 * Application configuration shared by all test types
 */
return [
    'id' => 'basic-tests',
    'name' => 'TestTask',
    'basePath' => dirname(__DIR__),
    'layout' => 'resume',
    'language' => 'ru-RU',
    'sourceLanguage' => 'ru-RU',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'inflection' => [
            'class' => 'wapmorgan\yii2inflection\Inflection',
        ],
        'formatter' => [
            'locale' => 'ru-RU',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'db' => $db,
        'mailer' => [
            'useFileTransport' => true,
        ],
        'assetManager' => [
            'basePath' => __DIR__ . '/../web/assets',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => [
                '/' => 'site/index',
                'myresume' => 'site/myresume',
                'create/resume' => 'site/create',
                'site/experience' => 'site/experience',
                'myresume/detail/<id:\d+>' => 'site/detail',
                'myresume/delete/<id:\d+>' => 'site/delete',
                'myresume/edit/<id:\d+>' => 'site/edit',
                'myresume/update/<id:\d+>' => 'site/update',
            ],
        ],
        'request' => [
            'cookieValidationKey' => 'test',
            'enableCsrfValidation' => false,
            // but if you absolutely need it set cookie domain to localhost
            /*
            'csrfCookie' => [
                'domain' => 'localhost',
            ],
            */
        ],
    ],
    'params' => $params,
];
