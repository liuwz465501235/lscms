<?php

use source\LsYii;
use source\core\widgets\ActiveForm;
use source\helpers\Url;
use source\libs\Constants;
use source\helpers\Html;
use source\modules\system\models\config\ThemeConfig;
use source\libs\Message;
use source\modules\system\models\config\DatetimeConfig;

/* @var $this yii\web\View */
/* @var $model backend\models\config\BasicConfig */
/* @var $form ActiveForm */
$this->title = LsYii::gT("Datetime Setting");
?>
<?=Message::getMessage();?>
<div class="page-header">
    <h3>
        <strong><?=Html::encode($this->title)?></strong>
    </h3>
</div>
<div class="config-basic">

    <?php $form = ActiveForm::begin([
        'id'=>'theme-config-form',
        'options'=>[
            'class'=>'form-horizontal'
        ]
        
    ]); 
    ?>
        <?= $form->field($model, 'datetime_timezone')->dropDownList( DatetimeConfig::getTimezoneItems()); ?>
        <?= $form->field($model, 'datetime_date_format'); ?>
        <?= $form->field($model, 'datetime_time_format')->radioList( Constants::getDateTimeTimeFormat()); ?>
        <?php Html::SubmitButtons("Save");?>
    <?php ActiveForm::end(); ?>

</div>