<?php

use source\LsYii;
use source\helpers\Html;
use source\core\grid\GridView;
use source\core\grid\ActionColumn;
use source\modules\rbac\models\Permission;

/* @var $this yii\web\View */
/* @var $searchModel source\modules\rbac\models\search\PermissionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$category =  LsYii::getGetValue('category');
$this->title = Permission::getCategoryItems( $category );
?>
<?=source\libs\Message::getMessage();?>
<div class="page-header">
    <h3>
        <strong><?=Html::encode($this->title)?></strong>
        <div class="pull-right">
            <?=Html::a('<span class="glyphicon glyphicon-plus"></span> ' . LsYii::gT('添加' . $this->title), ['/rbac/permission/create' , 'category'=>$category], ['class'=>'btn btn-primary'])?>
        </div>
    </h3>
</div>
<div class="permission-index">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'category',
            'name',
            'description',
            'form',
            [
                'class' => 'source\core\grid\ActionColumn',
                'template'=>'{update} {delete}',
                'buttons'=>[
                    'update'=>function($url , $model)
                    {
                        return Html::a('<span class="glyphicon glyphicon-edit"></span>', ['/rbac/permission/update' , 'id'=>$model->id ,'category'=>LsYii::getGetValue('category')], []);
                    },
                    'delete'=>function($url , $model)
                    {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['/rbac/permission/delete' , 'id'=>$model->id ,'category'=>LsYii::getGetValue('category')], ['data-method'=>'post' , 'data-confirm'=>LsYii::gT('Are you sure you want to delete this item?')]);
                    }
                ],
            ],
        ],
    ]); ?>

</div>
