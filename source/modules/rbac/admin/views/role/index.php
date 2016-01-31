<?php

use source\LsYii;
use source\helpers\Html;
use source\core\grid\GridView;
use source\core\grid\ActionColumn;
use source\modules\rbac\models\Role;

/* @var $this yii\web\View */
/* @var $searchModel source\modules\rbac\models\search\RoleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$category =  LsYii::getGetValue('category');
$this->title = Role::getCategoryItems( $category );
?>
<?=source\libs\Message::getMessage();?>
<div class="page-header">
    <h3>
        <strong><?=Html::encode($this->title)?></strong>
        <div class="pull-right">
            <?=Html::a('<span class="glyphicon glyphicon-plus"></span> ' . LsYii::gT('添加' . $this->title), ['/rbac/role/create' , 'category'=>$category], ['class'=>'btn btn-primary'])?>
        </div>
    </h3>
</div>
<div class="role-index">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'name',
            'description',
            [
                'class' => 'source\core\grid\ActionColumn',
                'template'=>'{access} {update} {delete}',
                'buttons'=>[
                    'access'=>function($url , $model)
                    {
                        if($model->id == 'administrator')
                        {
                            return '';
                        }
                        else
                        {
                            return Html::a('<span class="glyphicon glyphicon-list-alt"></span>', ['/rbac/role/access' , 'id'=>$model->id , 'category'=>LsYii::getGetValue('category')], []);
                        }
                    },
                    'update'=>function($url , $model)
                    {
                        if(!$model->is_system)
                        {
                            return Html::a('<span class="glyphicon glyphicon-edit"></span>', ['/rbac/role/update' , 'id'=>$model->id ,'category'=>LsYii::getGetValue('category')], []);
                        }
                    },
                    'delete'=>function($url , $model)
                    {
                        if(!$model->is_system)
                        {
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['/rbac/role/delete' , 'id'=>$model->id ,'category'=>LsYii::getGetValue('category')], ['data-method'=>'post' , 'data-confirm'=>LsYii::gT('Are you sure you want to delete this item?')]);
                        }
                    }
                ],
            ],
        ],
    ]); ?>

</div>
