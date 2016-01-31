<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model source\modules\rbac\models\Assignment */

$this->title = 'Update Assignment: ' . ' ' . $model->user;
$this->params['breadcrumbs'][] = ['label' => 'Assignments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->user, 'url' => ['view', 'user' => $model->user, 'role' => $model->role]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="assignment-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
