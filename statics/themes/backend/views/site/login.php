<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\bootstrap\ActiveForm;
use source\LsYii;
use source\helpers\Html;
use yii\bootstrap\Widget;
use source\core\back\BackView;
use source\libs\Resource;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
$this->registerJs("$(function(){
    $('#captchaImg').click();
})" , BackView::POS_END);
?>
<style type="text/css">
    .wrapper {background: url(<?php echo Resource::getAdminLoginBackground();?>) no-repeat center center;}
    .wrapper .admin-title {text-align: center;font-weight: bolder;font-size: 30px;color: white;}
</style>
<div class="wrapper">
    <div class="wrapper-box">
        <div class="admin-title">
            <?=LsYii::gT("网站后台管理");?>
        </div>
        <div class="admin-form">
            <?php $form =  ActiveForm::begin([
                'id'=>'login-form'
            ]);?>           
                <ul>
                    <li class="admin-user">
                        <?php
                            $attribute = 'username';
                            $name = $model->getAttributeLabel($attribute);
                            $input = Html::activeTextInput($model, $attribute, ['enter'=>'totab' , 'placeholder'=>$name , 'autocomplete'=>'off']);
                            echo Html::label("<span></span>" . $input, Html::getInputId($model, $attribute), ['class'=>'clear']);
                        ?>               
                    </li>
                    <li class="admin-pwd">
                        <?php
                            $attribute = 'password';
                            $name = $model->getAttributeLabel($attribute);
                            $input = Html::activePasswordInput($model, $attribute, ['enter'=>'totab' , 'placeholder'=>$name , 'autocomplete'=>'off']);
                            echo Html::label("<span></span>" . $input, Html::getInputId($model, $attribute), ['class'=>'clear']);
                        ?>                  
                    </li>
                    <li class="admin-caphe clear">
                        <?php
                            $attribute = 'verifyCode';
                            $name = $model->getAttributeLabel($attribute);
                            $input = Html::activeTextInput($model, $attribute, ['enter'=>'totab' , 'placeholder'=>$name , 'autocomplete'=>'off']);
                            echo Html::label("<span></span>" . $input, Html::getInputId($model, $attribute), ['class'=>'clear']);
                            echo Html::beginTag('div');
                            echo yii\captcha\Captcha::widget([
                                'name'=>'captchaimage',
                                'imageOptions'=>[
                                    'id'=>'captchaImg',
                                    'title'=>'换一个',
                                    'alt'=>'换一个',
                                    'style'=>'cursor:pointer;'
                                ],
                                'template'=>'{image}'
                            ]);
                            echo Html::endTag('div');
                        ?>
                    </li>
                    <li class="error-message" <?php echo empty($message)?'':'style="display: block;"'?>>
                        <?php echo $message;?>
                    </li>
                    <li class="admin-submit">
                        <input class="btn btn-default" type="submit" name="yt0" value="登录" />                    
                    </li>
                </ul>
            <?php  ActiveForm::end();?>       
        </div>
    </div>
</div>