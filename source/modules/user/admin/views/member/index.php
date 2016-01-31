<?php

use source\LsYii;
use source\helpers\Html;
use source\core\grid\GridView;
use source\core\grid\ActionColumn;
use source\models\User;
use source\libs\Constants;
use source\modules\rbac\models\Role;


/* @var $this yii\web\View */
/* @var $searchModel source\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '注册会员';
?>
<?=source\libs\Message::getMessage();?>
<div class="page-header">
    <h3>
        <strong><?=Html::encode($this->title)?></strong>
        <div class="pull-right">
            <?=Html::a('<span class="glyphicon glyphicon-plus"></span> ' . LsYii::gT('添加' . $this->title), ['/user/member/create'], ['class'=>'btn btn-primary'])?>
        </div>
    </h3>
</div>
<div class="user-index">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute'=>'username',
                'value'=>'username'
            ],
            [
                'attribute'=>'email',
                'value'=>'email'
            ],
            [
                'attribute'=>'status',
                'filter'=>  Constants::getStatusItems(),
                'content'=>function($model,$key,$index,$gridView)
                {
                    return Constants::getStatusItems( $model->status );
                }
            ],
            [
                'attribute'=>'role',
                'value'=>'role',
                'filter'=> Role::getMemberItems()
            ],
            [
                'class' => 'yii\grid\ActionColumn'
            ],
        ],
    ]); ?>

</div>
