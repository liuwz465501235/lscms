<?php 
use source\LsYii;
use source\libs\Resource;
use source\helpers\Html;
//use source\models\Menu;

install\assets\AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= Html::encode("LsYii CMS安装向导 ——" . $this->title) ?></title>
    <?= Html::csrfMetaTags() ?>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link rel="shortcut icon" href="favicon.ico" />
    <?php $this->head() ?>
    <style type="text/css" id="custom-background-css">
        body.custom-background { background-color: #f0f0f0; }
    </style>
</head>

<body class="home blog custom-background chrome">
<!--    <div class="site-top">
        <div class="clearfix container">
            <div class="site-branding">
                <h1 class="site-title">
                    <?=Html::a("LsYii CMS", LsYii::getHostInfo(), array('target'=>'_blank' , 'rel'=>'home' , 'title' => "LsYii CMS"));?>
                </h1>
            </div>
        </div>
         .site-top 
    </div>-->
    <nav id="w0" class="navbar-inverse navbar-fixed-top navbar" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#w0-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">LsCMS</a>
            </div>
            <div id="w0-collapse" class="collapse navbar-collapse">
                <ul id="w1" class="navbar-nav navbar-right nav">
                    <?php 
                    if(LsYii::getActionId() == 'stop')
                    {
                    ?>
                        <li <?php echo LsYii::getActionId()=='stop' ? 'class="active"' : '';?> ><a href="javascript:void(0)">安装停止</a></li>
                    <?php
                    } else {
                    ?>
                        <li <?php echo LsYii::getActionId()=='index' ? 'class="active"' : '';?> ><a href="javascript:void(0)">阅读协议</a></li>
                        <li <?php echo LsYii::getActionId()=='env' ? 'class="active"' : '';?>><a href="javascript:void(0)">环境检测</a></li>
                        <li <?php echo LsYii::getActionId()=='db' ? 'class="active"' : '';?>><a href="javascript:void(0)">填写信息</a></li>
                        <li <?php echo LsYii::getActionId()=='progress' ? 'class="active"' : '';?>><a href="javascript:void(0)">安装中</a></li>
                        <li <?php echo LsYii::getActionId()=='complete' ? 'class="active"' : '';?>><a href="javascript:void(0)">安装完成</a></li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="site-main">
        <div class="clearfix container">
            <div class="row">
                <?php echo $content;?>
            </div>
        </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
