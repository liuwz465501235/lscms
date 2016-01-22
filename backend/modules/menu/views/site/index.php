<?php

use source\helpers\Html;
use yii\grid\GridView;
use source\LsYii;
use common\widgets\TreeView;
use common\models\Menu;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\MenuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '菜单管理';
?>
<?=\source\libs\Message::getSuccessMessage();?>
<?=\source\libs\Message::getErrorMessage();?>
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
    echo TreeView::widget([
        'data'=>Menu::getTreeData(null , 0 , true , false , [
            'updateUrl'=>'/menu/site/update',
            'addChildrenUrl'=>'/menu/site/create',
            'deleteUrl'=>'/menu/site/delete',
        ])
    ]);
    ?>

</div>
