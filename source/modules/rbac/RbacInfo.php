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
        $this->name = 'Rbac Module';
        $this->version = '1.0';
        $this->description = 'Rbac description';
    }
}
