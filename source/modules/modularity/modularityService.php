<?php

namespace source\modules\modularity;

use source\LsYii;
use source\libs\Common;
use source\libs\Constants;
use source\core\modularity\ModuleService;
use source\core\modularity\ModuleInfo;
use source\modules\modularity\models\Modularity;
use source\helpers\Html;
use source\helpers\Url;
use source\helpers\StringHelper;
use source\helpers\ArrayHelper;

class modularityService extends \source\core\modularity\ModuleService
{

    public function init()
    {
        parent::init();
    }
    
    public function getServiceId()
    {
        return 'modularityService';
    }
    
    public function getActiveModules($isAdmin = FALSE)
    {
        $ret = [];
        
        $field = $isAdmin ? 'enable_admin' : 'enable_home';
        
        $allModules = Modularity::find()->where([$field => 1])->addOrderBy('id')->all();
        
        $modules = $this->loadAllModules();
    }
    
    public function loadAllModules()
    {
        
    }
}
