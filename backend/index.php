<?php
use source\LsYii;
use source\libs\Common;
use source\core\back\BackApplication;
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require(dirname(__DIR__) . '/vendor/autoload.php');
require(dirname(__DIR__) . '/vendor/yiisoft/yii2/Yii.php');
require(dirname(__DIR__) . '/source/override.php');
require(dirname(__DIR__) . '/common/config/bootstrap.php');
require(dirname(__DIR__) . '/backend/config/bootstrap.php');

$config = yii\helpers\ArrayHelper::merge(
    require(dirname(__DIR__) . '/common/config/main.php'),
    require(dirname(__DIR__) . '/common/config/main-local.php'),
    require(dirname(__DIR__) . '/backend/config/main.php'),
    require(dirname(__DIR__) . '/backend/config/main-local.php')
);
//检测用户是否安装了程序
Common::checkInstall($config);
$application = new BackApplication($config);
Yii::setAlias('@web', '/');
Yii::setAlias('@webroot', dirname(__DIR__));
\source\core\back\BackView::setTheme();
$application->run();
