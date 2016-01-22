<?php
/**
 * 公用应用基类Application
 * @author Weizhong Liu<liuweizhong4655@gmail.com>
 * @since 1.0
 * @date 1/16/2016
 */
namespace source\core\base;

use source\LsYii;
use source\helpers\ArrayHelper;
use yii\web\Application;
use common\models\Config;
use source\traits\CommonTrait;

class BaseApplication extends Application
{
    use CommonTrait;
    
    public $name;
    public $activeModules = [];


    public function init()
    {
        parent::init();
        $this->name = self::getSiteName();
    }
    
    /**
     * 获取网站的名称
     * @return type
     */
    public static function getSiteName()
    {
        $site_name = Config::getConfig('site_name');
        return $site_name ? $site_name : '';
    }
    
    public function loadActiveModules($isAdmin)
    {
        $moduleManager = $this->modularityService;
        
        $this->activeModules = $moduleManager->getActiveModules($isAdmin);
    }
}
