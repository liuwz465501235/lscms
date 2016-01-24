<?php

use source\LsYii;
use source\helpers\Html;
use source\core\widgets\ActiveForm;
use source\libs\Constants;
use source\libs\Resource;
use source\modules\category\models\Category;
use source\helpers\Url;
use backend\assets\AppAsset;

/* @var $this yii\web\View */
/* @var $model source\models\Category */
/* @var $form yii\widgets\ActiveForm */
$this->registerJsFile(Resource::getAdminUrl('/default/js/bootstrap-smartsearch.js') , ['depends'=>'yii\web\YiiAsset']);
?>

<div class="category-form">

    <?php $form = ActiveForm::begin([
        'id'=>'category-form',
        'options'=>[
            'class'=>'form-horizontal'
        ]
    ]);
    ?>
    <?php $disabeld = $model->isNewRecord ? false : true;?>
    <?= $form->field($model, 'pid')->textInput([
        'class' => 'form-control',
        'autocomplete' => 'off',
        'data-provide' => "smartsearch",
        'data-items' => "all",
        'data-source' => Category::getToJson(),
        'data-value' => $model->pid,
        'disabled'=>$disabeld
    ]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'if_show')->radioList( Constants::getCategoryStatus() ); ?>

    <?= $form->field($model, 'memo')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'sort')->textInput() ?>

    <?php 
        $submitText = $model->isNewRecord ? "新建" : "修改";
        $closeLink = Url::to(['/category/default/index']);
        Html::SubmitButtons($submitText, $closeLink);
    ?>
    <?php ActiveForm::end(); ?>
</div>
