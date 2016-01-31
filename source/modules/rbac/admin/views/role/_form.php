<?php
use source\helpers\Html;
use yii\grid\GridView;
use source\LsYii;
use source\core\widgets\ActiveForm;
use source\helpers\Url;
use source\libs\Constants;
use source\modules\rbac\models\Role;
/* @var $this yii\web\View */
/* @var $model source\modules\rbac\models\Role */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="role-form">

    <?php $form = ActiveForm::begin([
        'id'=>'role-form',
        'options'=>[
            'class'=>'form-horizontal'
        ]
    ]); ?>

    <?= $form->field($model, 'id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
    
    <?php 
        $submitText = $model->isNewRecord ? "新建" : "修改";
        $closeLink = Url::to(['/rbac/role/index' , 'category'=> LsYii::getGetValue('category')]);
        Html::SubmitButtons($submitText, $closeLink);
    ?>

    <?php ActiveForm::end(); ?>

</div>
