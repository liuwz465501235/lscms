<?php

namespace source\modules\system;

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\StringHelper;
use yii\helpers\ArrayHelper;
use source\LsYii;
use source\libs\Common;
use source\libs\Constants;

class SystemInfo extends \source\core\modularity\ModuleInfo
{

    public function init()
    {
        parent::init();
        
        $this->id='system';
        $this->name = '系统模块';
        $this->version = '1.0';
        $this->description = '系统设置，如站点配置、SEO设置、时间等';
        $this->is_system = 1;
    }
}
