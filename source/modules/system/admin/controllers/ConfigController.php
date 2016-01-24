<?php
/**
 * 系统配置控制器Controller
 * @author Weizhong Liu<liuweizhong4655@gmail.com>
 * @since 1.0
 * @date 1/16/2016
 */
namespace source\modules\system\admin\controllers;

use source\LsYii;
use source\core\back\BackController;
use source\modules\system\models\config\BasicConfig;
use source\modules\system\models\config\SeoConfig;
use source\modules\system\models\config\ThemeConfig;
use source\modules\system\models\config\AccessConfig;
use source\modules\system\models\config\DatetimeConfig;
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
        }
        return $this->render('access' , [
            'model'=>$model
        ]);
    }
    
    /**
     * 时间设置
     * @return type
     */
    public function actionDatetime()
    {
        $this->setMenus(10, "时间设置");
        $model = new DatetimeConfig();
        if($model->load( LsYii::getRequest()->post() ))
        {
            $model->save( $model->attributes );
            LsYii::setSuccessMessage( LsYii::gT('save success') );
        }
        else
        {
            $model = $model->initValue();
        }
        return $this->render('datetime' , [
            'model'=>$model
        ]);
    }
}
