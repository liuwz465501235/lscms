<?php

use yii\helpers\Html;
use source\core\widgets\ActiveForm;
use source\helpers\Url;
use source\libs\Constants;

/* @var $this yii\web\View */
/* @var $model backend\models\config\BasicConfig */
/* @var $form ActiveForm */
$this->params['breadcrumbs'] = [
    '设置',
    '基础设置'
];
?>
<div class="page-header">
    <h3>
        <strong>访问与注册配置</strong>
    </h3>
</div>
<div class="config-basic">
    <?php
        echo \common\widgets\TreeView::widget([
        ]);
    ?>

</div>