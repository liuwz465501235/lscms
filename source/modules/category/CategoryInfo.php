<?php

namespace source\modules\category;

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\StringHelper;
use yii\helpers\ArrayHelper;
use source\LsYii;
use source\libs\Common;
use source\libs\Constants;

class CategoryInfo extends \source\core\modularity\ModuleInfo
{

    public function init()
    {
        parent::init();
        
        $this->id='category';
        $this->name = '分类模块';
        $this->version = '1.0';
        $this->description = '与系统分类管理相关的模块';
    }
}
