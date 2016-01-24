<?php
/**
 * 公用控制器基类Controller
 * @author Weizhong Liu<liuweizhong4655@gmail.com>
 * @since 1.0
 * @date 1/16/2016
 */
namespace source\core\base;

use source\LsYii;
use yii\web\Controller;
use yii\base\Component;
use yii\base\View;
use yii\web\Response;
use source\traits\CommonTrait;

class BaseController extends Controller
{
    use CommonTrait;
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
