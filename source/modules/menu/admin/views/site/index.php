<?php

use source\helpers\Html;
use yii\grid\GridView;
use source\LsYii;
use common\widgets\TreeView;
use source\modules\menu\models\Menu;

/* @var $this yii\web\View */
/* @var $searchModel source\models\search\MenuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '菜单管理';

$this->registerJs("$(function(){
    $('.nav-tabs .active').mouseover(function(){
        $(this).find('.attribute-remove').show();
    }).mouseout(function(){
        $(this).find('.attribute-remove').hide();
    });
    $('.nav-tabs .active .attribute-remove').click(function(){
        window.open('".\source\helpers\Url::to(['/menu/site/delete' , 'id'=>$model->id])."' , '_self');
        return false;
    });
})", \source\core\back\BackView::POS_END);
?>
<?=source\libs\Message::getMessage();?>
<div class="page-header">
    <h3>
        <strong><?=Html::encode($this->title)?></strong>
        <div class="pull-right">
            <?=  Html::a('<span class="glyphicon glyphicon-plus"></span> ' . LsYii::gT('添加新菜单'), ['/menu/site/create'], ['class'=>'btn btn-primary'])?>
        </div>
    </h3>
</div>
<div class="menu-index">
    <?php
    echo yii\bootstrap\Tabs::widget([
        'items'=>Menu::getItems($model->id , '/menu/site/index'),
    ]);
    echo TreeView::widget([
        'data'=>Menu::getTreeData($model->root, $model->id, true , false , [
            'updateUrl'=>'/menu/site/update',
            'addChildrenUrl'=>'/menu/site/create',
            'deleteUrl'=>'/menu/site/delete',
        ])
    ]);
    ?>

</div>
