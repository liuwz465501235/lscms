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
        <strong>SEO配置</strong>
    </h3>
</div>
<div class="config-basic">

    <?php $form = ActiveForm::begin([
        'id'=>'seo-config-form',
        'options'=>[
            'class'=>'form-horizontal'
        ]
    ]); ?>

        <?= $form->field($model, 'seo_title'); ?>
        <?= $form->field($model, 'seo_keywords'); ?>
        <?= $form->field($model, 'seo_description'); ?>
        <?= $form->field($model, 'seo_head'); ?>

        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary center-block']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div>