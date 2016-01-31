<?php

use source\LsYii;
use source\helpers\Html;
use source\helpers\Url;
use source\libs\Constants;
use source\models\User;
use source\core\widgets\ActiveForm;
use source\modules\rbac\models\Role;

/* @var $this yii\web\View */
/* @var $model source\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin([
        'id'=>'adminuser-form',
        'options'=>[
            'class'=>'form-horizontal'
        ]
    ]); ?>

    <?= $form->field($model, 'username')->textInput(); ?>
    
    
    <?= $form->field($model, 'password')->passwordInput(); ?>
    <?= $form->field($model, 'repassword')->passwordInput(); ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->radioList( Constants::getStatusItems() ); ?>

    <?= $form->field($model, 'role')->dropDownList( Role::getAdminItems(null , false) ); ?>

    <?php 
        $submitText = $model->isNewRecord ? "新建" : "修改";
        $closeLink = Url::to(['/user/adminuser/index']);
        Html::SubmitButtons($submitText, $closeLink);
    ?>

    <?php ActiveForm::end(); ?>

</div>
