<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use source\LsYii;
use source\helpers\Html;

$this->title = $name;
?>
<style>
    #main-content {
        margin-left: 0px;
    }
    .container {
        width: 100%;
    }
    .due-time {
        color: red;
    }
</style>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>
    
    <p>
        页面将在<span class="due-time">3</span>秒后自动跳转，如未跳转<?=Html::a(\source\LsYii::gT('这里'), LsYii::getRequest()->getReferrer() , ["node-type"=>"run-link"]);?>
    </p>
</div>
<?php
$this->registerJs("$(function() {
        var dt = setInterval(function() {
            var due = $('.due-time').html();
            if(parseInt(due) <= 1) {
                clearInterval(dt);
                var url = $('a[node-type=run-link]').attr('href');
                window.location.href = url;
            }
            $('.due-time').html(parseInt(due) - 1);
        } , 1000);
     })", yii\web\View::POS_END);
?>
