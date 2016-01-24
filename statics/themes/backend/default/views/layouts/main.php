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
use source\models\Menu;

AppAsset::registerDefault();
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode(LsYii::getName() . '-' . $this->title) ?></title>
        <style>
            ul li {
                list-style: none;
            }
        </style>
        <?php $this->head() ?>
    </head>
    <body class="container-body">
        <?php $this->beginBody() ?>
        <div class="navbar navbar-inverse navbar-fixed-top bs-docs-nav">
            <div class="container bs-docs-container clear">
                <div class="navbar-header">
                    <?=Html::a(LsYii::getApp()->name, Url::to(['site/index']), ['class'=>'navbar-brand'])?>
                </div>
                <?php
                    echo Nav::widget([
                        'options'=>[
                            'class'=>'nav navbar-nav'
                        ],
                        'items'=>Menu::getTopMenu()
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
        <?php echo Menu::getSideMenu();?>
        <div class="content" role="main" id="main-content">
            <div class="container">
                <?php $this->params['breadcrumbs'] = source\core\back\BackView::createBreadcrumbs();?>
                <?=Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>                        
                <?php echo $content; ?>                   
            </div>
        </div>
        <?php $this->endBody() ?>
    </body>
    <script>
            $(function(){
                $("#subnav").on("click", "h3", function(){
                    var $this = $(this);
                    $this.find(".icon").toggleClass("icon-fold");
                    $this.next().slideToggle("fast").siblings(".side-sub-menu:visible").
                          prev("h3").find("i").addClass("icon-fold").end().end().hide();
                })
                $(".side-sub-menu li").hover(function(){
                    $(this).addClass("hover");
                },function(){
                    $(this).removeClass("hover");
                });
            })
        </script>
</html>
<?php $this->endPage() ?>
