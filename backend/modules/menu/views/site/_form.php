<?php

use source\LsYii;
use source\helpers\Html;
use source\core\widgets\ActiveForm;
use source\libs\Constants;
use source\libs\Resource;
use common\models\Menu;
use source\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Menu */
/* @var $form yii\widgets\ActiveForm */
$this->registerJsFile( Resource::getAdminUrl('/js/bootstrap-smartsearch.js') , ['depends'=>'yii\web\YiiAsset']);

//LsYii::getView()->registerJsFile( Resource::getAdminUrl('/js/bootstrap-smartsearch.js') , ['depends'=>'yii\web\YiiAsset']);
?>

<div class="menu-form">

    <?php $form = ActiveForm::begin([
        'id'=>'menu-form',
        'options'=>[
            'class'=>'form-horizontal'
        ]
    ]); ?>
    <?php $disabeld = $model->isNewRecord ? false : true;?>
    <?= $form->field($model, 'pid')->textInput([
        'class' => 'form-control',
        'autocomplete' => 'off',
        'data-provide' => "smartsearch",
        'data-items' => "all",
        'data-value' => $model->pid,
        'data-source' => Menu::getToJson(),
        'disabled'=>$disabeld
    ]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'if_show')->radioList( Constants::getMenuStatus() ); ?>

    <?= $form->field($model, 'memo')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'sort')->textInput() ?>

    <?php 
        $submitText = $model->isNewRecord ? "新建" : "修改";
        $closeLink = Url::to(['/menu/site/index']);
        Html::SubmitButtons($submitText, $closeLink);
    ?>
    <?php ActiveForm::end(); ?>

</div>
