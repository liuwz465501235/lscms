<?php

use source\helpers\Html;
use yii\grid\GridView;
use source\LsYii;
use source\modules\dict\models\Dict;
use source\modules\dict\models\DictCategory;
/* @var $this yii\web\View */
/* @var $model source\models\Dict */

$this->title = '修改字典';
?>
<?=source\libs\Message::getMessage();?>
<div class="page-header">
    <h3>
        <strong><?=Html::encode($this->title)?></strong>
        <small><?=  Html::encode( DictCategory::getDictCategoryName($category_id) . '-' . $model->name)?></small>
    </h3>
</div>
<div class="dict-update">
    <?= $this->render('_form', [
        'model' => $model,
        'category_id'=>$category_id
    ]) ?>

</div>
