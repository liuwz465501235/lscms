<?php

namespace source\core\modularity;

use source\LsYii;
class BaseModule extends \source\core\base\BaseModule
{
    const Status_Installed = 'Installed';
    
    const Status_Uninstalled = 'Unistalled';
    
    const Status_Activity = 'Activity';
    
    const Status_Inactivity = 'Inactivity';
    
    public $status;
    
    public $modularityService;
    
    public $moduleInfo;
    
    public function init()
    {
        parent::init();
        $this->modularityService = LsYii::getService('modularity');
    }
    
    public function getMenus()
    {
        return [];
    }
    
    public function getRoutings()
    {
        
    }
    
    public function getPermissions()
    {
        
    }
}
