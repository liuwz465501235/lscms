<?php

use source\LsYii;
use source\helpers\Html;
use source\core\widgets\ActiveForm;
use source\helpers\Url;
use source\libs\Constants;
use source\libs\Message;

/* @var $this yii\web\View */
/* @var $model backend\models\config\BasicConfig */
/* @var $form ActiveForm */

$this->title = LsYii::gT('Register And Visit');
?>
<?=Message::getMessage();?>
<div class="page-header">
    <h3>
        <strong><?=  Html::encode($this->title)?></strong>
    </h3>
</div>
<div class="config-basic">
    <?php $form = ActiveForm::begin([
        'id'=>'access-config-form',
        'options'=>[
            'class'=>'form-horizontal'
        ]
    ]); ?>

        <?= $form->field($model, 'allow_register')->checkbox([] , false); ?>

        <?php Html::SubmitButtons("Save");?>
    <?php ActiveForm::end(); ?>
</div>