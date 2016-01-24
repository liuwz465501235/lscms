<?php

namespace source\modules\modularity;

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\StringHelper;
use yii\helpers\ArrayHelper;
use source\LsYii;
use source\libs\Common;
use source\libs\Constants;

class ModularityInfo extends \source\core\modularity\ModuleInfo
{

    public function init()
    {
        parent::init();
        
        $this->id='modularity';
        $this->name = '模块管理';
        $this->version = '1.0';
        $this->description = '用来对系统中的模块进行管理';
        $this->is_system = 1;
    }
}
