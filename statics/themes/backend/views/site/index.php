<?php
use source\LsYii;

$this->params['breadcrumbs'] = [
    '首页'
];
?>
<div class="container bs-docs-container">
    <div class="row admin-index">
        <div class="col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading"><?php echo LsYii::gT("商品管理");?></div>
                <div class="panel-body form-horizontal">
                    <div class="form-group bs-form-group-index">
                        <label for="inputEmail3" class="col-sm-2 control-label"><?php echo LsYii::gT("商品数量");?></label>
                        <div class="col-sm-4">
                            <span class="col-color col-color-now"><?php // echo $itemCount;?></span>
                            <?php // echo CHtml::link("查看",array("/admin/item/admin"),array('class'=>'see'))?>
                        </div>
                        <label for="inputEmail3" class="col-sm-2 control-label"><?php echo LsYii::gT("商品分类");?></label>
                        <div class="col-sm-4">
                            <span class="col-color col-color-now"><?php // echo $cateCount;?></span>
                            <?php // echo CHtml::link("查看",array("/admin/itemcategory/admin"),array('class'=>'see'))?>
                        </div>
                    </div>
                    <div class="form-group bs-form-group-index">
                        <label for="inputEmail3" class="col-sm-2 control-label"><?php echo LsYii::gT("上架商品");?></label>
                        <div class="col-sm-4">
                            <span class="col-color col-color-now"><?php // echo $shelvesitemCount;?></span>
                            <?php // echo CHtml::link("查看",array("/admin/item/admin"),array('class'=>'see'))?>
                        </div>
                        <label for="inputEmail3" class="col-sm-2 control-label"><?php echo LsYii::gT("推荐商品");?></label>
                        <div class="col-sm-4">
                            <span class="col-color col-color-now"><?php // echo $recommendCount;?></span>
                            <?php // echo CHtml::link("查看",array("/admin/item/admin"),array('class'=>'see'))?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading"><?php echo LsYii::gT("其它");?></div>
                <div class="panel-body form-horizontal">
                    <div class="form-group bs-form-group-index">
                        <label for="inputEmail3" class="col-sm-2 control-label"><?php echo LsYii::gT("注册用户");?></label>
                        <div class="col-sm-4">
                            <span class="col-color col-color-now"><?php // echo $userCount;?></span>
                            <?php // echo CHtml::link("查看",array("/admin/user/admin"),array('class'=>'see'))?>                   
                        </div>
                        <label for="inputEmail3" class="col-sm-2 control-label"><?php echo LsYii::gT("管理员数量");?></label>
                        <div class="col-sm-4">
                            <span class="col-color col-color-now"><?php // echo $adminuserCount;?></span>
                            <?php // echo CHtml::link("查看",array("/admin/adminuser/admin"),array('class'=>'see'))?>                     
                        </div>
                    </div>
                    <div class="form-group bs-form-group-index">
                        <label for="inputEmail3" class="col-sm-2 control-label"><?php echo LsYii::gT("广告数量");?></label>
                        <div class="col-sm-4">
                            <span class="col-color col-color-now"><?php // echo $advertisement;?></span>
                            <?php // echo CHtml::link("查看",array("/admin/advertisement/admin"),array('class'=>'see'))?>                 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>        
</div>