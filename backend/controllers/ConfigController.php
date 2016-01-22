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
use backend\models\config\ThemeConfig;
use backend\models\config\AccessConfig;
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
        $this->setMenus(6, "Basic Setting");
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
        $this->setMenus(7, "SEO Setting");
        $model = new SeoConfig();
        if($model->load( LsYii::getRequest()->post() ))
        {
            $model->save( $model->attributes );
            LsYii::setSuccessMessage( LsYii::gT('save success') );
        }
        else
        {
            $model = $model->initValue();
        }
        return $this->render('seo' , [
            'model'=>$model
        ]);
    }
    
    /**
     * 主题设置
     * @return type
     */
    public function actionTheme()
    {
        $this->setMenus(8, "Theme Setting");
        $model = new ThemeConfig();
        if($model->load( LsYii::getRequest()->post() ))
        {
            $model->save( $model->attributes );
            LsYii::setSuccessMessage( LsYii::gT('save success') );
        }
        else
        {
            $model = $model->initValue();
            if(!$model->admin_theme)
                $model->admin_theme = 'default';
            if(!$model->home_theme)
                $model->home_theme = 'default';
        }
        return $this->render('theme' , [
            'model'=>$model
        ]);
    }

    /**
     * 访问与注册设置
     * @return type
     */
    public function actionAccess()
    {
        $this->setMenus(44, "Register And Visit");
        $model = new AccessConfig();
        if($model->load( LsYii::getRequest()->post() ))
        {
            $model->save( $model->attributes );
            LsYii::setSuccessMessage( LsYii::gT('save success') );
        }
        else
        {
            $model = $model->initValue();
            if(!$model->allow_register)
                $model->allow_register = 1;
        }
        return $this->render('access' , [
            'model'=>$model
        ]);
    }
}
