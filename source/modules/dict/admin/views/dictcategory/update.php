<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model source\models\DictCategory */

$this->title = '修改字典分类';
?>
<?=source\libs\Message::getMessage();?>
<div class="page-header">
    <h3>
        <strong><?=Html::encode($this->title)?></strong>
        <small><?=Html::encode($model->name)?></small>
    </h3>
</div>
<div class="dict-category-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
