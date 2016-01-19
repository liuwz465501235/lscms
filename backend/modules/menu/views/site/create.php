<?php

use source\LsYii;
use source\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Menu */

$this->title = '添加菜单';
$this->params['breadcrumbs'][] = ['label' => 'Menus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-header">
    <h3>
        <strong><?=Html::encode($this->title)?></strong>
        <div class="pull-right">
            <?=  Html::a('<span class="glyphicon glyphicon-share-alt"></span> ' . LsYii::gT('返回'), ['/menu/site/index'], ['class'=>'btn btn-primary'])?>
        </div>
    </h3>
</div>
<div class="menu-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
