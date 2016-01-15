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
        <?php $this->head() ?>
    </head>
    <body class="container-body">
        <?php $this->beginBody() ?>
        <div class="navbar navbar-inverse navbar-fixed-top bs-docs-nav">
            <div class="container bs-docs-container clear">
                <div class="navbar-header">
                    <?=Html::a(LsYii::getApp()->name, Url::to(['site/index']), ['class'=>'navbar-brand'])?>
                </div>
                <ul class="nav navbar-nav">
                    <li class="active"><?=Html::a( LsYii::gT("首页"), Url::to(['site/index']))?></li>
                    <li><a href="">设置</a></li>
                    <li><a href="<?=Url::to(['menucategory/index'])?>">系统</a></li>
                    <li><a href="">内容</a></li>
                    <li><a href="">碎片</a></li>
                    <li><a href="">用户</a></li>
                    <li><a href="">主题</a></li>
                    <li><a href="">其它</a></li>
                </ul>                
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
                    <li class="logout">
                        <?=  Html::a( LsYii::gT('退出登录') , Url::to(['site/logout']) , ['data-method'=>'post']);?>
                    </li>
                </ul>
            </div>
        </div>
        <div class="container bs-docs-container">
            <div class="row">
                <div class="content col-md-10" role="main" id="contents" style="height: 553px;">
                    <div class="container" style="height:100%;">
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
