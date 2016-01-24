<?php
use source\helpers\Html;
use yii\grid\GridView;
use source\LsYii;
use source\modules\dict\models\Dict;
use source\modules\dict\models\DictCategory;

/* @var $this yii\web\View */
/* @var $model source\models\Dict */
$this->title = '添加字典';
?>
<?=source\libs\Message::getMessage();?>
<div class="page-header">
    <h3>
        <strong><?=Html::encode($this->title)?></strong>
        <small><?=  Html::encode( DictCategory::getDictCategoryName($category_id))?></small>
    </h3>
</div>
<div class="dict-create">
    <?= $this->render('_form', [
        'model' => $model,
        'category_id'=>$category_id
    ]) ?>

</div>
