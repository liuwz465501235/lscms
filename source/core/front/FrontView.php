<?php
/**
 * 前台视图基类View
 * @author Weizhong Liu<liuweizhong4655@gmail.com>
 * @since 1.0
 * @date 1/16/2016
 */
namespace source\core\front;

use source\core\base\BaseView;
use source\LsYii;
use source\libs\Resource;
use source\core\base\Theme;

class FrontView extends BaseView
{
    public function init()
    {
        parent::init();
    }
    
    /**
     * 设置前台主题的路径
     */
    public static function setTheme(){
    }
}
