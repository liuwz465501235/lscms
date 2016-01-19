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

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
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
                        'items'=>  \common\models\Menu::getTopMenu()
                    ]);
                ?>
                <ul class="nav navbar-nav navbar-right">
<!--                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">中文【中文】 <b class="caret"></b></a>                    <ul class="dropdown-menu">
                            <li><a href="/admin/main/setLanguageSession.html?language=zh&amp;url=%252Fadmin%252Fmain%252Findex.html">中文【中文】</a></li><li><a href="/admin/main/setLanguageSession.html?language=cht&amp;url=%252Fadmin%252Fmain%252Findex.html">中文繁體【中文繁体】</a></li><li><a href="/admin/main/setLanguageSession.html?language=en&amp;url=%252Fadmin%252Fmain%252Findex.html">English【英语】</a></li><li><a href="/admin/main/setLanguageSession.html?language=jp&amp;url=%252Fadmin%252Fmain%252Findex.html">日本語【日语】</a></li><li><a href="/admin/main/setLanguageSession.html?language=kor&amp;url=%252Fadmin%252Fmain%252Findex.html">한국어【韩语】</a></li><li><a href="/admin/main/setLanguageSession.html?language=spa&amp;url=%252Fadmin%252Fmain%252Findex.html">El español【西班牙语】</a></li><li><a href="/admin/main/setLanguageSession.html?language=fra&amp;url=%252Fadmin%252Fmain%252Findex.html">Français【法语】</a></li><li><a href="/admin/main/setLanguageSession.html?language=th&amp;url=%252Fadmin%252Fmain%252Findex.html">ภาษาไทย【泰语】</a></li><li><a href="/admin/main/setLanguageSession.html?language=ara&amp;url=%252Fadmin%252Fmain%252Findex.html">عربي&nbsp;【阿拉伯语】</a></li><li><a href="/admin/main/setLanguageSession.html?language=ru&amp;url=%252Fadmin%252Fmain%252Findex.html">русский язык&nbsp;【俄罗斯语】</a></li><li><a href="/admin/main/setLanguageSession.html?language=pt&amp;url=%252Fadmin%252Fmain%252Findex.html">Português【葡萄牙语】</a></li><li><a href="/admin/main/setLanguageSession.html?language=yue&amp;url=%252Fadmin%252Fmain%252Findex.html">粤语【粤语】</a></li><li><a href="/admin/main/setLanguageSession.html?language=de&amp;url=%252Fadmin%252Fmain%252Findex.html">Deutsch【德语】</a></li><li><a href="/admin/main/setLanguageSession.html?language=it&amp;url=%252Fadmin%252Fmain%252Findex.html">In Italiano【意大利语】</a></li><li><a href="/admin/main/setLanguageSession.html?language=nl&amp;url=%252Fadmin%252Fmain%252Findex.html">De Nederlandse【荷兰语】</a></li><li><a href="/admin/main/setLanguageSession.html?language=el&amp;url=%252Fadmin%252Fmain%252Findex.html">Ελληνική γλώσσα【希腊语】</a></li>                    </ul>
                    </li>-->
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
        <div class="sidebar">
            <!-- 子导航 -->

            <div id="subnav" class="subnav">
                <!-- 子导航 -->
                <!-- /子导航 --> 
                <h3>
                    <i class="icon"></i>站点设置
                </h3>
                <ul class="side-sub-menu subnav-off">
                    <li><a class="item" href="<?=  Url::to(['/config/basic'])?>">基础配置</a></li>
                    <li><a class="item" href="<?=  Url::to(['/config/seo'])?>">SEO配置</a></li>		
                </ul>
                <h3>
                    <i class="icon"></i>基础功能
                </h3>
                <ul class="side-sub-menu subnav-off">
                    <li><a class="item" href="<?=  Url::to(['/menu/site/index']);?>">菜单管理</a></li>	
                </ul>
            </div>
            <!-- /子导航 -->
        </div>

        <div class="content" role="main" id="main-content">
            <div class="container">
                <?=Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>                        
                <?php echo $content; ?>                   
            </div>
        </div>
<!--        <div class="container bs-docs-container">
            <div class="row">
                <div class="col-md-2">
                    <div class="bs-sidebar hidden-print affix-top">
                        <ul class="nav bs-sidenav" style="height:567px">
                            <li class="active"><a href="javascript:void(0)">系统配置</a></li>
                            <ul class="nav">
                                <li><a href="<?=  Url::to(['/config/basic']);?>">基础配置</a></li>
                                <li><a href="<?= Url::to(['/config/seo']);?>">SEO配置</a></li>
                                <li><a href="<?=  Url::to(['/config/register']);?>">注册设置</a></li>
                                <li><a href="">模板主题配置</a></li>
                            </ul>
                            <li class="active"><a href="javascript:void(0)">相关设置</a></li>
                            <ul class="nav">
                                <li><a href="<?=Url::to(['/menu/site/index']);?>">菜单管理</a></li>
                                <li><a href="">分类管理</a></li>
                            </ul>
                            <li class="active"><a href="javascript:void(0)">管理员设置</a></li>
                            <ul class="nav">
                                <li class="active"><a href="">管理员管理</a></li>
                                <li><a href="">管理员组管理</a></li>
                            </ul>
                        </ul>
                    </div>
                </div>
                <div class="content col-md-10" role="main" id="contents" style="height: 553px;">
                    <div class="container" style="height:100%;">
                        <?=Breadcrumbs::widget([
                            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        ]) ?>
                        <?php echo $content; ?>
                    </div>
                </div>    
            </div>
        </div>-->
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
