<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\assets;

use yii\web\AssetBundle;
use source\LsYii;
use source\libs\Resource;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
    
    /**
     * 向默认主题的文件中注册静态资源
     */
    public static function registerDefault()
    {
        self::registerCssFile('/default/css/common.css');
        self::registerCssFile('/default/css/styles.css');
        self::registerJsFile('/default/js/bootstrap.min.js');
        self::registerJsFile('/default/js/respond.min.js');
    }
    
    /**
     * 向基本主题的文件中注册静态资源
     */
    public static function registerBasic()
    {
        self::registerCssFile('/basic/css/common.css');
        self::registerCssFile('/basic/css/styles.css');
        self::registerJsFile('/basic/js/bootstrap.min.js');
        self::registerJsFile('/basic/js/respond.min.js');
    }
    
    /**
     * 向视图文件中注册视图资源
     * @param type $cssfile
     */
    public static function registerCssFile($cssfile)
    {
        $cssUrl = Resource::getAdminUrl($cssfile);
        LsYii::getView()->registerCssFile($cssUrl , ['depends'=>'yii\bootstrap\BootstrapAsset']);
    }
    
    /**
     * 向视图中注册默认的js资源
     * @param type $jsFile
     */
    public static function registerJsFile($jsFile)
    {
        $jsUrl = Resource::getAdminUrl($jsFile);
        LsYii::getView()->registerJsFile($jsUrl , ['depends'=>'yii\web\YiiAsset']);
    }
}
