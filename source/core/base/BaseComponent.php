<?php
/**
 * 公用组件基类Component
 * @author Weizhong Liu<liuweizhong4655@gmail.com>
 * @since 1.0
 * @date 1/16/2016
 */
namespace source\core\base;

use source\LsYii;
use yii\base\Component;
use source\traits\CommonTrait;

class BaseComponent extends Component
{
    use CommonTrait;
    
    public function init()
    {
        parent::init();
    }
}
