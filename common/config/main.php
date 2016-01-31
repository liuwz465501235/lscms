<?php
$db = require(__DIR__ . '/db.php');
$rules = require(__DIR__ . '/rules.php');
return [
    'language'=>'zh-CN',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        //配置数据库
        'db'=>$db,
        //配置缓存
        'cache' => [
            'class' => 'yii\caching\FileCache',
            'cachePath'=>'@data/cache',
        ],
        //配置schema缓存
        'schemaCache' => [
            'class' => 'yii\caching\FileCache',
            'cachePath'=>'@data/cache',
            'keyPrefix'=>'scheme_'
        ],
        //assets配置
        'assetManager'=>[
            'basePath'=>'@webroot/statics/assets',
            'baseUrl'=>'@web/statics/assets'
        ],
        //加密组件配置
        'security' => [
            'class' => 'source\core\base\Security',
        ],
        //语言包配置
        'i18n'=>[
            'translations'=>[
                'yii'=>[
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                    'fileMap' => [
                        'yii' => 'yii.php',
                    ],
                ],
                'field'=>[
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                    'fileMap' => [
                        'field' => 'field.php',
                    ],
                ],
            ],
        ],
        //配置模块组件
        'modularityService' => [
            'class' => 'source\modules\modularity\ModularityService',
        ],
        //配置url路径
//        'urlManager' => [      
//            'enablePrettyUrl' => true,      
//            'showScriptName' => false,     
//            'suffix'=>'.html',
//            'rules'=>$rules,
//        ],
    ],
];
