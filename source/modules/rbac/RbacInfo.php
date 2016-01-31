<?php

namespace source\modules\rbac;

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\StringHelper;
use yii\helpers\ArrayHelper;
use source\LsYii;
use source\libs\Common;
use source\libs\Constants;

class RbacInfo extends \source\core\modularity\ModuleInfo
{

    public function init()
    {
        parent::init();
        
        $this->id='rbac';
        $this->name = '权限控制模块';
        $this->version = '1.0';
        $this->description = '管理站点的各项权限，如控制器权限、系统权限等';
        
        $this->is_system = 1;
    }
}
