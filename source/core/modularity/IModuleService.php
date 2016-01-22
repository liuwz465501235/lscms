<?php
/**
 * Module服务的接口
 * @author Weizhong Liu <liuweizhong4655@gmail.com>
 * @since 1.0
 * @date 1/21/2016
 */

namespace source\core\modularity;

use source\LsYii;
interface IModuleService
{
    /**
     * 获取Module服务的id属性
     */
    public function getServiceId();
}
