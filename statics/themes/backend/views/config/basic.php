<?php

use yii\helpers\Html;
use source\LsYii;
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
<?=\source\libs\Message::getSuccessMessage();?>
<?=\source\libs\Message::getErrorMessage();?>
<div class="page-header">
    <h3>
        <strong>基础设置</strong>
    </h3>
</div>
<div class="config-basic">

    <?php $form = ActiveForm::begin([
        'id'=>'basic-config-form',
        'options'=>[
            'class'=>'form-horizontal'
        ]
    ]); ?>

        <?= $form->field($model, 'site_name'); ?>
        <?= $form->field($model, 'site_description'); ?>
        <?= $form->field($model, 'site_domain'); ?>
        <?= $form->field($model, 'site_email'); ?>
        <?= $form->field($model, 'site_language')->dropDownList( source\libs\Language::aLangs());?>
        <?= $form->field($model, 'sys_icp'); ?>
        <?= $form->field($model, 'site_about'); ?>
        <?= $form->field($model, 'site_status')->radioList( Constants::getWebSiteStatus() )?>

        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary center-block']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div>