<?php

use source\LsYii;
use source\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Menu */

$this->title = '添加菜单';
?>
<div class="page-header">
    <h3>
        <strong><?=Html::encode($this->title)?></strong>
    </h3>
</div>
<div class="menu-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
