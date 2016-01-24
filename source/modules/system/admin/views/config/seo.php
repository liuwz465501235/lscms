<?php

use source\LsYii;
use source\core\widgets\ActiveForm;
use source\helpers\Url;
use source\libs\Constants;
use source\helpers\Html;
use source\libs\Message;

/* @var $this yii\web\View */
/* @var $model backend\models\config\BasicConfig */
/* @var $form ActiveForm */
$this->title = LsYii::gT("SEO Setting");
?>
<?=Message::getMessage();?>
<div class="page-header">
    <h3>
        <strong><?=Html::encode($this->title)?></strong>
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

        <?php Html::SubmitButtons("Save");?>
    <?php ActiveForm::end(); ?>

</div>