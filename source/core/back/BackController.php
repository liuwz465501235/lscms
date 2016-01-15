<?php

namespace source\core\back;

use source\LsYii;
use source\core\base\BaseController;

class BackController extends BaseController
{
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
}
