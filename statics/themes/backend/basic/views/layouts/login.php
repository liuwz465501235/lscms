<?php

/* @var $this \yii\web\View */
/* @var $content string */

use source\LsYii;
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use source\libs\Resource;

AppAsset::registerBasic();
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode( LsYii::getName() ) ?></title>
    <?php AppAsset::registerCssFile('/basic/css/admin_login.css');?>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <?=$content;?>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>