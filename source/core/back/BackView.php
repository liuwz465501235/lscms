<?php
/**
 * 公用视图基类View
 * @author Weizhong Liu<liuweizhong4655@gmail.com>
 * @since 1.0
 * @date 1/16/2016
 */
namespace source\core\back;

use source\core\base\BaseView;
use source\LsYii;
use source\libs\Resource;
use source\core\base\Theme;


class BackView extends BaseView
{
    public function init()
    {
        parent::init();
    }
    
    public static function setTheme() {
    }
}
