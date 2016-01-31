<?php
use source\helpers\Html;
use yii\grid\GridView;
use source\LsYii;
use source\modules\rbac\models\Role;

/* @var $this yii\web\View */
/* @var $model source\modules\rbac\models\Role */

$category = LsYii::getGetValue('category');
$this->title = "编辑".Role::getCategoryItems($category);
?>
<?=source\libs\Message::getMessage();?>
<div class="page-header">
    <h3>
        <strong><?=Html::encode($this->title)?></strong>
        <small><?=Html::encode($model->name)?></small>
    </h3>
</div>
<div class="role-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
