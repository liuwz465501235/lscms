<?php

use source\helpers\Html;
use source\core\grid\GridView;
use source\LsYii;
use source\libs\Message;
/* @var $this yii\web\View */
/* @var $searchModel source\modules\modularity\models\search\ModularitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = source\LsYii::gT('Modularity Setting');
?>
<?=Message::getMessage();?>
<div class="page-header">
    <h3>
        <strong><?=Html::encode($this->title);?></strong>
        <div class="pull-right">
            <?=Html::a(\Yii::t('yii' ,'<span class="glyphicon glyphicon-plus"></span> Create {attribute}',['attribute'=>LsYii::gT('Modularity')]), ['/gii/default/view','id'=>'lsmodule'], ['class' => 'btn btn-primary' ,'target'=>'_blank'])?>
        </div>
    </h3>
</div>
<div class="modularity-index">
    <?php
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'layout' => '{items} {summary} {pager}',
        'tableOptions' => ['class'=>'table table-hover'],
        'columns' => [
            [
                'label'=>'标识',
                'value'=>'id'
            ],
            [
                'label'=>'名称',
                'value'=>'instance.name'
            ],
            [
                'label'=>'描述',
                'value'=>'instance.description'
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{system} {install} {admin} {home}',
                'buttons'=>[
                    'system'=>function($url , $data)
                    {
                        return $data["instance"]->is_system ? "系统内置" : "";
                    },
                    'install'=>function($url , $data)
                    {
                        if(!$data["instance"]->is_system)
                        {
                            if($data["canInstall"]===true)
                                return Html::a("安装",['/modularity/default/install' , 'id'=>$data['id']], []);
                            else if($data["canUninstall"]===true && $data["canInstall"]===false)
                                return Html::a("卸载", ['/modularity/default/uninstall' , 'id'=>$data['id']], []);
                            else
                                return '';
                        }
                        else
                        {
                            return '';
                        }
                    },
                    'admin'=>function($url , $data)
                    {
                        if(!$data["instance"]->is_system && $data["canInstall"]===false)
                        {
                            if($data["hasAdmin"]===true && $data["canActiveAdmin"]===true)
                                return Html::a("启用后台" , ['/modularity/default/active' , 'id'=>$data['id'] , 'isAdmin'=>1] , []);
                            else if($data["hasAdmin"]===true && $data["canActiveAdmin"]===false)
                                return Html::a("关闭后台" , ['/modularity/default/deactive' , 'id'=>$data['id'] , 'isAdmin'=>1] , []);
                            else
                                return '';
                        }
                        else
                        {
                            return '';
                        }
                    },
                    'home'=>function($url , $data)
                    {
                        if(!$data["instance"]->is_system && $data["canInstall"]===false)
                        {
                            if($data["hasHome"]===true && $data["canActiveHome"]===true)
                                return Html::a("启用前台" , ['/modularity/default/active' , 'id'=>$data['id']] , []);
                            else if($data["hasHome"]===true && $data["canActiveHome"]===false)
                                return Html::a("关闭前台" , ['/modularity/default/deactive' , 'id'=>$data['id']] , []);
                            else
                                return '';
                        }
                        else
                        {
                            return '';
                        }
                    }
                ],
            ],
        ],
    ]); 
    ?>

</div>
