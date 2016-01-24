<?php

use source\helpers\Html;
use yii\grid\GridView;
use source\LsYii;
use source\modules\dict\models\Dict;
use source\modules\dict\models\DictCategory;
use source\core\grid\ActionColumn;

/* @var $this yii\web\View */
/* @var $searchModel source\models\search\DictSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '字典管理';
?>
<?=source\libs\Message::getMessage();?>
<div class="page-header">
    <h3>
        <strong><?=Html::encode($this->title)?></strong>
        <small><?=  Html::encode(DictCategory::getDictCategoryName($category_id))?></small>
        <div class="pull-right">
            <?=  Html::a('<span class="glyphicon glyphicon-plus"></span> ' . LsYii::gT('添加字典'), ['/dict/dict/create' , 'category_id'=>$category_id], ['class'=>'btn btn-primary'])?>
            <?=  Html::a('<span class="glyphicon glyphicon-share-alt"></span> ' . LsYii::gT('Return'), ['/dict/dictcategory/index'], ['class'=>'btn btn-primary'])?>
        </div>
    </h3>
</div>
<div class="dict-index">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => '{items} {summary} {pager}',
        'tableOptions' => ['class'=>'table table-hover'],
        'columns' => [
            [
                'attribute'=>'name',
            ],
            [
                'attribute'=>'value',
            ],
            [
                'attribute'=>'status',
                'filter'=>\source\libs\Constants::getDictStatus(),
                'content'=>function($model,$key,$index,$gridView)
                {
                    return \source\libs\Constants::getDictStatus( $model->status );
                }
            ],
            [
                'attribute'=>'sort',
                'filter'=>  Html::activeInput('text', $searchModel, 'sort' , ['class'=>'form-control'])
            ],
            [
                'class' => 'source\core\grid\ActionColumn',
                'template'=>'{update} {delete}',
                'buttons'=>[
                    'view'=>function($url , $model)
                    {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['/dict/dict/view' , 'id'=>$model->id , 'category_id'=>LsYii::getGetValue('category_id')], []);
                    },
                    'update'=>function($url , $model)
                    {
                        return Html::a('<span class="glyphicon glyphicon-edit"></span>', ['/dict/dict/update' , 'id'=>$model->id , 'category_id'=>LsYii::getGetValue('category_id')], []);
                    },
                    'delete'=>function($url , $model)
                    {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['/dict/dict/delete' , 'id'=>$model->id , 'category_id'=>LsYii::getGetValue('category_id')], ['data-method'=>'post' , 'data-confirm'=>LsYii::gT('Are you sure you want to delete this item?')]);
                    }
                ],
            ],
        ],
    ]); ?>

</div>
