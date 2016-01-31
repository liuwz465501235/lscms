<?php
use source\helpers\Html;
use yii\grid\GridView;
use source\LsYii;
use source\modules\rbac\models\Permission;


/* @var $this yii\web\View */
/* @var $model source\modules\rbac\models\Role */
$category = LsYii::getGetValue('category');
$this->title = "修改" . Permission::getCategoryItems($category);
?>
<div class="permission-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
