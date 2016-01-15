<?php

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
