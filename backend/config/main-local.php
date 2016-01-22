<?php

$config = [
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '41SCN-vryMrrUOuOzXXcGo0GP4zBgMhr',
        ],
    ],
];

if (!YII_ENV_TEST) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class'=>'yii\gii\Module',
        'generators'=>[
            'lulumodule'=>'backend\gii\generators\lscmsmodule\Generator',
            'lulumodel'=>'backend\gii\generators\lscmsmodel\Generator',
            'lulucrud'=>'backend\gii\generators\lscmscrud\Generator',
        ],
    ];
}

return $config;