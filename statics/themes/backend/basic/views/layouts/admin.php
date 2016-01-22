<?php
/* @var $this \yii\web\View */
/* @var $content string */

use source\LsYii;
use backend\assets\AppAsset;
use source\helpers\Html;
use source\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use source\core\back\BackView;

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
        <?php $this->head() ?>
    </head>
    <body class="container-body">
        <?php $this->beginBody() ?>
        <div class="navbar navbar-inverse navbar-fixed-top bs-docs-nav">
            <div class="container bs-docs-container clear">
                <div class="navbar-header">
                    <?=Html::a(LsYii::getName(), Url::to(['site/index']), ['class'=>'navbar-brand'])?>
                </div>
                <?php
                    echo Nav::widget([
                        'options'=>[
                            'class'=>'nav navbar-nav'
                        ],
                        'items'=>  \common\models\Menu::getTopMenu()
                    ]);
                ?>              
                <ul class="nav navbar-nav navbar-right">
                    <li class=""></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?=LsYii::getIdentity()->username?> <b class="caret"></b></a>                    
                        <ul class="dropdown-menu">
                            <li>
                                <?=Html::a('<span class="glyphicon glyphicon-user"></span> ' . LsYii::gT("个人资料"), Url::to(['site/profile']), []);?>
                            </li>
                            <li>
                                <?=Html::a('<span class="glyphicon glyphicon-pencil"></span> ' . LsYii::gT("修改密码"), Url::to(['site/modifyPwd']), []);?>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <?=  Html::a( LsYii::gT('退出登录') , Url::to(['site/logout']) , ['data-method'=>'post']);?>
                    </li>
                </ul>
            </div>
        </div>
        <div class="container bs-docs-container">
            <div class="row">
                <div class="content col-md-10" role="main" id="contents" style="height: 553px;padding: 0px 10px;">
                    <div class="container" style="height:100%;">
                        <?php $this->params['breadcrumbs'] = source\core\back\BackView::createBreadcrumbs();?>
                        <?=Breadcrumbs::widget([
                            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        ]) ?>
                        <?php echo $content; ?>
                    </div>
                </div>    
            </div>
        </div>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
