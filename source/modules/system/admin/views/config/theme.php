<?php

use source\LsYii;
use source\core\widgets\ActiveForm;
use source\helpers\Url;
use source\libs\Constants;
use source\helpers\Html;
use source\modules\system\models\config\ThemeConfig;
use source\libs\Message;

/* @var $this yii\web\View */
/* @var $model backend\models\config\BasicConfig */
/* @var $form ActiveForm */
$this->title = LsYii::gT("Theme Setting");
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
        <?= $form->field($model, 'admin_theme')->radioList(ThemeConfig::getAdminItems()); ?>
        <?= $form->field($model, 'home_theme')->radioList(ThemeConfig::getHomeItems()); ?>
        <?php Html::SubmitButtons("Save");?>
    <?php ActiveForm::end(); ?>

</div>