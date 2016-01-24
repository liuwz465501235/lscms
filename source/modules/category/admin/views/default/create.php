<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model source\models\Category */

$this->title = '添加分类';
?>
<div class="page-header">
    <h3>
        <strong><?=Html::encode($this->title)?></strong>
    </h3>
</div>
<div class="category-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
