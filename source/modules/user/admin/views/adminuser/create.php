<?php
use source\LsYii;
use source\helpers\Html;
use source\models\User;


/* @var $this yii\web\View */
/* @var $model source\models\User */
$this->title = '新建后台管理员';
?>
<?=source\libs\Message::getMessage();?>
<div class="page-header">
    <h3>
        <strong><?=Html::encode($this->title)?></strong>
    </h3>
</div>
<div class="user-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
