<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);


return [
    'id' => 'app-frontend',
    'name' => 'ТОСТЕР',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'user' => [
            'class' => 'frontend\modules\user\Module',
        ],
        'question' => [
            'class' => 'frontend\modules\question\Module',
        ],
        'tags' => [
            'class' => 'frontend\modules\tags\Module',
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'frontend\models\User',
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
            'rules' => [
                'profile/<nickname:\w+>' => 'user/profile/view',
                'edit/<nickname:\w+>' => 'user/profile/edit',
                'question/create'  => 'question/default/create',
                'question/<id:\d+>' => 'question/default/view',
                'tag/<id:\d+>' => 'tags/default/view',
                'tags' => 'tags/default/index',
                'tags/create' => 'tags/default/create',
                'my/feed' => 'user/profile/feed'
            ],
        ],
        'storage' => [
          'class' => 'frontend\components\Storage',
        ],
    ],
    'params' => $params,
];
