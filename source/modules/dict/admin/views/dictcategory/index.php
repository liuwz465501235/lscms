<?php

use source\helpers\Html;
use yii\grid\GridView;
use source\LsYii;
use source\modules\dict\models\DictCategory;

/* @var $this yii\web\View */
/* @var $searchModel source\models\search\DictCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '字典分类';
?>
<?=  \source\libs\Message::getMessage();?>
<div class="page-header">
    <h3>
        <strong><?=Html::encode($this->title)?></strong>
        <div class="pull-right">
            <?=  Html::a('<span class="glyphicon glyphicon-plus"></span> ' . LsYii::gT('添加字典分类'), ['/dict/dictcategory/create'], ['class'=>'btn btn-primary'])?>
        </div>
    </h3>
</div>
<div class="dict-category-index">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => '{items} {summary} {pager}',
        'tableOptions' => ['class'=>'table table-hover'],
        'columns' => [
            'id',
            'name',
            'description',
            [
                'class'=>'source\core\grid\ActionColumn',
                'template'=>'{view} {update} {delete}',
                'buttons'=>[
                    'view'=>function($url , $model)
                    {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', source\helpers\Url::to(['/dict/dict/index' , 'category_id'=>$model->id]), []);
                    },
                ],
            ],
        ],
    ]); ?>

</div>
