<?php
/**
 * 公用控制器基类Controller
 * @author Weizhong Liu<liuweizhong4655@gmail.com>
 * @since 1.0
 * @date 1/16/2016
 */
namespace source\core\back;

use source\LsYii;
use source\core\base\BaseController;

class BackController extends BaseController
{
    /**
     * 后台顶部菜单的id
     */
    public $topMenu;
    /**
     * 后台侧边菜单的id
     */
    public $sideMenu;
    /**
     * 面包屑中的最后的字符串
     */
    public $lastBreadcrumb;
    
    public function beforeAction($action)
    {
        if( !parent::beforeAction($action) )
        {
            return fale;
        }
        //1.检查不需要验证的方法
        if( in_array($action->uniqueID , $this->ignoreLogin()))
        {
            return parent::beforeAction($action);
        }
        //检查用户是否登录
        if( LsYii::getIsGuest() )
        {
            return $this->redirect(['site/login']);
        }
        return parent::beforeAction($action);
    }
    
    /**
     * 返回不需要登录的方法
     */
    public function ignoreLogin() 
    {
        return [
            'site/login',
            'site/captcha'
        ];
    }
    
    public function setMenus($sideMenu , $lastBreadcrumb)
    {
        $this->sideMenu = $sideMenu;
        $this->lastBreadcrumb = $lastBreadcrumb;
    }
}
