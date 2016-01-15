<?php

namespace source\core\base;

use source\LsYii;
use yii\web\Controller;
use yii\base\Component;
use yii\base\View;
use yii\web\Response;

class BaseController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    
    public function init()
    {
        parent::init();
        LsYii::getResponse()->on(Response::EVENT_AFTER_SEND , [$this , 'afterResponse']);
    }
    
    public function afterResponse() {
        
    }
}
