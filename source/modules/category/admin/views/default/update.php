<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model source\models\Category */

$this->title = '修改分类';
?>
<div class="page-header">
    <h3>
        <strong><?=Html::encode($this->title);?></strong>
        <small><?=Html::encode($model->name);?></small>
    </h3>
</div>
<div class="category-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
