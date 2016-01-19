<?php

use source\LsYii;
use source\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Menu */

$this->title = '更新菜单';
$this->params['breadcrumbs'][] = ['label' => 'Menus', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="page-header">
    <h3>
        <strong><?=Html::encode($this->title);?></strong>
        <small><?=Html::encode($model->name);?></small>
        <div class="pull-right">
            <?=Html::a('<span class="glyphicon glyphicon-share-alt"></span> ' . LsYii::gT('返回'), ['/menu/site/index'], ['class'=>'btn btn-primary'])?>
        </div>
    </h3>
</div>
<div class="menu-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
