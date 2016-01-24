<?php

namespace source\modules\modularity;

use source\LsYii;
use source\libs\Common;
use source\libs\Constants;
use source\core\modularity\ModuleService;
use source\core\modularity\ModuleInfo;
use source\modules\modularity\models\Modularity;
use source\helpers\FileHelper;
use source\helpers\VarDumper;

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
        
        $allModules = Modularity::find()->where([$field => 1])->indexBy('id')->all();
        
        $modules = $this->loadAllModules();
        foreach($modules as $m)
        {
            $moduleId = $m['id'];
            
            if(array_key_exists($moduleId, $allModules))
            {
                $ret[$moduleId] = [
                    'id'=>$m['id'],
                    'dir'=>$m['dir'],
                    'dirClass'=>$m['dirClass'],
                    'class'=>$m['class'],
                    'instance'=>$m['instance']
                ];
            }
        }
        return $ret;
    }
    
    public function getAllModules()
    {
        $ret = [];
        
        $allModules = Modularity::find()->indexBy('id')->all(); //数据库中的模块
        $modules = $this->loadAllModules(); //文件路径中已存在的模块
        foreach ($modules as $m)
        {
            $moduleId = $m['id'];
            
            $ret[$moduleId] = $m;
            if (array_key_exists($moduleId, $allModules))
            {
                $exitModule = $allModules[$moduleId];
                
                if ($ret[$moduleId]['hasAdmin'])
                {
                    $ret[$moduleId]['canActiveAdmin'] = !$exitModule['enable_admin'] ? true : false;
                }
                if ($ret[$moduleId]['hasHome'])
                {
                    $ret[$moduleId]['canActiveHome'] = !$exitModule['enable_home'] ? true : false;
                }
                $ret[$moduleId]['canInstall'] = false;
                $ret[$moduleId]['canUninstall'] = (($ret[$moduleId]['hasAdmin'] && $exitModule['enable_admin']) || ($ret[$moduleId]['hasHome'] && $exitModule['enable_home'])) ? false : true;
            
                $ret[$moduleId]['instance']->is_system = $exitModule['is_system'];
                $ret[$moduleId]['instance']->is_content = $exitModule['is_content'];
            }
        }
        return $ret;
    }
    
    public $allModules = null;

    public function loadAllModules()
    {
        if($this->allModules !== null)
        {
            return $this->allModules;
        }
        $this->allModules = [];
        $moduleRootPath = LsYii::getAlias('@source') . '/modules';
        
        if($moduleRootDir = dir($moduleRootPath))
        {
            while(($moduleFolder = $moduleRootDir->read()) !== false)
            {
                $currentModuleDir = $moduleRootPath . '/' . $moduleFolder;
                if (preg_match('|^\.+$|', $moduleFolder) || ! is_dir($currentModuleDir))
                {
                    continue;
                }
                $moduleClassName = ucwords($moduleFolder);
                 if (FileHelper::exist($currentModuleDir . '/' . $moduleClassName . 'Info.php'))
                {
                    $class = 'source\modules\\' . $moduleFolder . '\\' . $moduleClassName . 'Info';
                }
                else
                {
                    continue;
                }
                $instance = null;
                try {
                    $instance = new $class();
                    if(empty($instance->id))
                    {
                        $instance->id = $moduleFolder;
                    }
                    if(empty($instance->name))
                    {
                        $instance->name = $moduleFolder;
                    }
                } catch (Exception $ex) {
                    $instance = null;
                }
                if($instance !== null)
                {
                    $hasAdmin = FileHelper::exist($currentModuleDir . '/admin/AdminModule.php') ? true : false;
                    $hasHome = FileHelper::exist($currentModuleDir . '/home/HomeModule.php') ? true : false;
                    
                    $this->allModules[$instance->id] = [
                        'id'=>$instance->id,
                        'dir'=>$moduleFolder,
                        'dirClass'=>$moduleClassName,
                        'class'=>$class,
                        'instance'=>$instance,
                        'canInstall'=>true,
                        'canUninstall'=>true,
                        'hasAdmin'=>$hasAdmin,
                        'hasHome'=>$hasHome,
                        'canActiveAdmin'=>false,
                        'canActiveHome'=>false
                    ];
                }
            }
        }
        return $this->allModules;
    }
}
