<?php

use source\LsYii;
use source\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Menu */

$this->title = '更新菜单';
?>
<div class="page-header">
    <h3>
        <strong><?=Html::encode($this->title);?></strong>
        <small><?=Html::encode($model->name);?></small>
    </h3>
</div>
<div class="menu-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
