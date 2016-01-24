<?php
use source\helpers\Html;
use yii\grid\GridView;
use source\LsYii;
use source\modules\dict\models\Dict;
use source\core\widgets\ActiveForm;
use source\helpers\Url;
use source\libs\Constants;

/* @var $this yii\web\View */
/* @var $model source\models\Dict */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dict-form">

    <?php $form = ActiveForm::begin([
        'id'=>'dict-form',
        'options'=>[
            'class'=>'form-horizontal'
        ]
    ]); ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'value'); ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->radioList( Constants::getDictStatus() ) ?>

    <?= $form->field($model, 'sort')->textInput() ?>

    <?php 
        $submitText = $model->isNewRecord ? "新建" : "修改";
        $closeLink = Url::to(['/dict/dict/index' , 'category_id'=>$category_id]);
        Html::SubmitButtons($submitText, $closeLink);
    ?>

    <?php ActiveForm::end(); ?>

</div>
