<?php
use source\helpers\Html;
use yii\grid\GridView;
use source\LsYii;
use source\core\widgets\ActiveForm;
use source\helpers\Url;
use source\libs\Constants;
use source\modules\rbac\models\Permission;
use source\modules\rbac\rules\Rule;

/* @var $this yii\web\View */
/* @var $model source\modules\rbac\models\Permission */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permission-form">

    <?php $form = ActiveForm::begin([
        'id'=>'permission-form',
        'options'=>[
            'class'=>'form-horizontal'
        ]
    ]); ?>

    <?= $form->field($model, 'id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'form')->radioList( Permission::getFormItems() );?>

    <?= $form->field($model, 'default_value')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'rule')->dropDownList( Rule::getRules() , ['prompt'=>'请选择']); ?>

    <?= $form->field($model, 'description')->textarea(['rows'=>6]) ?>
    
    <?= $form->field($model, 'sort_num')->textInput() ?>

    <?php 
        $submitText = $model->isNewRecord ? "新建" : "修改";
        $closeLink = Url::to(['/rbac/permission/index' , 'category'=> LsYii::getGetValue('category')]);
        Html::SubmitButtons($submitText, $closeLink);
    ?>

    <?php ActiveForm::end(); ?>

</div>
