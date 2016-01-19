<?php
/**
 * 系统配置控制器Controller
 * @author Weizhong Liu<liuweizhong4655@gmail.com>
 * @since 1.0
 * @date 1/16/2016
 */
namespace backend\controllers;

use source\LsYii;
use source\core\back\BackController;
use backend\models\config\BasicConfig;
use backend\models\config\SeoConfig;
use source\libs\Constants;

class ConfigController extends BackController
{
    public $topMenu = 4;
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    /**
     * 基础配置
     * @return type
     */
    public function actionBasic()
    {
        $model = new BasicConfig();
        if($model->load( LsYii::getRequest()->post() ))
        {
            $model->save($model->attributes);
            LsYii::setSuccessMessage( LsYii::gT('save success') );
        }
        else
        {
            $model = $model->initValue();
            if(!$model->site_language)
            {
                $model->site_language = 'zh-CN';
            }
            if(!$model->site_status)
            {
                $model->site_status = Constants::WebSite_Status_open;
            }
        }
        return $this->render('basic' , [
            'model'=>$model
        ]);
    }
    
    /**
     * SEO配置
     * @return type
     */
    public function actionSeo()
    {
        $model = new SeoConfig();
        if($model->load( LsYii::getRequest()->post() ))
        {
            $model->save( $model->attributes );
        }
        else
        {
            $model = $model->initValue();
        }
        return $this->render('seo' , [
            'model'=>$model
        ]);
    }
    
    public function actionRegister()
    {
        return $this->render('register');
    }
}
