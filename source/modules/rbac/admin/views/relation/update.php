<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model source\modules\rbac\models\Relation */

$this->title = 'Update Relation: ' . ' ' . $model->role;
$this->params['breadcrumbs'][] = ['label' => 'Relations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->role, 'url' => ['view', 'role' => $model->role, 'permission' => $model->permission]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="relation-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
