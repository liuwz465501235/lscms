<?php

namespace source\modules\rbac;

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\StringHelper;
use yii\helpers\ArrayHelper;
use source\LsYii;
use source\libs\Common;
use source\libs\Constants;

class RbacService extends \source\core\modularity\ModuleService
{

    public function init()
    {
        parent::init();
    }
    
    public function getServiceId()
    {
        return 'rbacService';
    }
}
