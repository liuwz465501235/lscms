<?php
use source\helpers\Html;
use source\LsYii;
use source\modules\rbac\models\Role;


/* @var $this yii\web\View */
/* @var $model source\modules\rbac\models\Role */
$category = LsYii::getGetValue('category');
$this->title = "新建" . Role::getCategoryItems($category);
?>
<?=source\libs\Message::getMessage();?>
<div class="page-header">
    <h3>
        <strong><?=Html::encode($this->title)?></strong>
    </h3>
</div>
<div class="role-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
