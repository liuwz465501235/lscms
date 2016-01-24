<?php

namespace source\modules\dict;

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\StringHelper;
use yii\helpers\ArrayHelper;
use source\LsYii;
use source\libs\Common;
use source\libs\Constants;

class DictInfo extends \source\core\modularity\ModuleInfo
{

    public function init()
    {
        parent::init();
        
        $this->id='dict';
        $this->name = '字典模块';
        $this->version = '1.0';
        $this->description = '常用的数据，如性别、文件章发布状态';
    }
}
