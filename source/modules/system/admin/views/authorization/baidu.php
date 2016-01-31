<?php

use source\LsYii;
use source\helpers\Html;
use source\core\widgets\ActiveForm;
use source\helpers\Url;
use source\libs\Constants;
use source\libs\Message;
use source\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\config\BasicConfig */
/* @var $form ActiveForm */

$this->title = LsYii::gT('QQ第三方登录设置');
?>
<?=Message::getMessage();?>
<div class="page-header">
    <h3>
        <strong><?=  Html::encode($this->title)?></strong>
    </h3>
</div>
<div class="config-basic">
    <?php $form = ActiveForm::begin([
        'id'=>'baidu-config-form',
        'options'=>[
            'class'=>'form-horizontal'
        ]
    ]); ?>
        <?=$form->field($model, 'baidu_appid');?>
        <?=$form->field($model, 'baidu_appkey');?>
        <?=$form->field($model, 'baidu_enable')->radioList( Constants::getThirdLoginStatus() );?>
        <?php Html::SubmitButtons("Save");?>
    <?php ActiveForm::end(); ?>
</div>