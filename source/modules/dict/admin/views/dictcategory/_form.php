<?php

use source\LsYii;
use source\helpers\Html;
use source\core\widgets\ActiveForm;
use source\helpers\Url;

/* @var $this yii\web\View */
/* @var $model source\models\DictCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dict-category-form">

    <?php $form = ActiveForm::begin([
        'id'=>'dictcategory-form',
        'options'=>[
            'class'=>'form-horizontal'
        ]
    ]); ?>

    <?= $form->field($model, 'id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows'=>6]) ?>
    
    <?php 
        $submitText = $model->isNewRecord ? "新建" : "修改";
        $closeLink = Url::to(['/dict/dictcategory/index']);
        Html::SubmitButtons($submitText, $closeLink);
    ?>

    <?php ActiveForm::end(); ?>

</div>
