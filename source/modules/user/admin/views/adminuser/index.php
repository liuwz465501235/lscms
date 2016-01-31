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

$this->title = '后台管理员';
?>
<?=source\libs\Message::getMessage();?>
<div class="page-header">
    <h3>
        <strong><?=Html::encode($this->title)?></strong>
        <div class="pull-right">
            <?=Html::a('<span class="glyphicon glyphicon-plus"></span> ' . LsYii::gT('添加' . $this->title), ['/user/adminuser/create'], ['class'=>'btn btn-primary'])?>
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
                'filter'=> Role::getAdminItems(),
                'content'=>function($model , $key , $index , $gridView)
                {
                    return Role::getAdminItems($model->role);
                }
            ],
            [
                'class' => 'source\core\grid\ActionColumn',
                'buttons'=>[
                    'update'=>function($url , $model)
                    {
                        if($model->role != 'administrator')
                        {
                            return Html::a('<span class="glyphicon glyphicon-edit"></span>', $url, []);
                        }
                        else
                        {
                            return '';
                        }
                    },
                    'delete'=>  function($url , $model)
                    {
                        if($model->role != 'administrator')
                        {
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, []);
                        }
                        else
                        {
                            return '';
                        }
                    }
                ],
            ],
        ],
    ]); ?>

</div>
