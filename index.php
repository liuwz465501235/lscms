<?php
use source\LsYii;
use source\libs\Common;
use source\core\front\FrontApplication;

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require(__DIR__ . '/vendor/autoload.php');
require(__DIR__ . '/vendor/yiisoft/yii2/Yii.php');
require(__DIR__ . '/source/override.php');
require(__DIR__ . '/common/config/bootstrap.php');
require(__DIR__ . '/frontend/config/bootstrap.php');

$config = yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/common/config/main.php'),
    require(__DIR__ . '/common/config/main-local.php'),
    require(__DIR__ . '/frontend/config/main.php'),
    require(__DIR__ . '/frontend/config/main-local.php')
);
//检测用户是否安装了程序
Common::checkInstall($config);
$app = new FrontApplication($config);
//$curr_language = LsYii::getLang();
//if($curr_language)
//    $app->language = $curr_language;
//else
//    $app->language = 'zh-CN';
$app->run();
