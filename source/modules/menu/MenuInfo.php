<?php

namespace source\modules\menu;

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\StringHelper;
use yii\helpers\ArrayHelper;
use source\LsYii;
use source\libs\Common;
use source\libs\Constants;

class MenuInfo extends \source\core\modularity\ModuleInfo
{

    public function init()
    {
        parent::init();
        
        $this->id='menu';
        $this->name = '菜单管理';
        $this->version = '1.0';
        $this->description = '提供所有的菜单功能支持';
    }
}
