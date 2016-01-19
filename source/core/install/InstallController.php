<?php
/**
 * 安装模块控制器基类Controller
 * @author Weizhong Liu<liuweizhong4655@gmail.com>
 * @since 1.0
 * @date 1/16/2016
 */
namespace source\core\install;

use source\core\base\BaseController;

class InstallController extends BaseController
{
    
    public function actions()
    {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                'width'=>80,
                'height'=>34,
                'maxLength'=>4,
                'minLength'=>4,
            ],
        ];
    }
    
    public function init()
    {
        parent::init();
    }
}
