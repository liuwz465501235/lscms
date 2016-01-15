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
    <div class="site-top">
        <div class="clearfix container">
            <div class="site-branding">
                <h1 class="site-title">
                    <?=Html::a("LsYii CMS", LsYii::getHostInfo(), array('target'=>'_blank' , 'rel'=>'home' , 'title' => "LsYii CMS"));?>
                </h1>
            </div>
           
        </div>
        <!-- .site-top -->
    </div>
    <div class="site-main">
        <div class="clearfix container">
            <div class="row">


<?php echo $content;?>
                
            </div>
        </div>
        <!-- .site-main -->
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
