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
use source\modules\system\models\config\QqConfig;
use source\modules\system\models\config\BaiduConfig;
use source\libs\Constants;

class AuthorizationController extends BackController
{
    public $topMenu = 4;
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    /**
     * QQ第三方登录设置
     * @return type
     */
    public function actionQq()
    {
        $this->setMenus(50, "QQ第三方登录设置");
        $model = new QqConfig();
        if($model->load( LsYii::getRequest()->post() ))
        {
            $model->save( $model->attributes );
            LsYii::setSuccessMessage( LsYii::gT('save success') );
        }
        else
        {
            $model = $model->initValue();
        }
        return $this->render('qq' , [
            'model'=>$model
        ]);
    }
    
    public function actionBaidu()
    {
        $this->setMenus(51, "百度第三方登录");
        $model = new BaiduConfig();
        if($model->load( LsYii::getRequest()->post() ))
        {
            $model->save( $model->attributes );
            LsYii::setSuccessMessage( LsYii::gT('save success') );
        }
        else
        {
            $model = $model->initValue();
        }
        return $this->render('baidu' , [
            'model'=>$model
        ]);
    }
}
