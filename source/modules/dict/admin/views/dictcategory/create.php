<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model source\models\DictCategory */

$this->title = '添加字典分类';
?>
<?=source\libs\Message::getMessage();?>
<div class="page-header">
    <h3>
        <strong><?=Html::encode($this->title)?></strong>
    </h3>
</div>
<div class="dict-category-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
