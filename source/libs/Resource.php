<?php

namespace source\libs;

use source\LsYii;
use source\libs\Common;

class Resource
{

    //加载css文件
    public static function cssFile($url)
    {
        echo '<link type="text/css" rel="stylesheet" href="' . $url . '" />' . "\n";
    }

    //加载js文件
    public static function jsFile($url)
    {
        echo '<script type="text/javascript" src="' . $url . '"></script>' . "\n";
    }

    /**
     * 得到后台程序的主题路径
     */
    public static function getAdminTheme()
    {
//        $theme = Common::getConfigValue('sys_theme_admin');
        $theme = 'backend';
        return $theme;
    }

    /**
     * 得到前台程序的主题路径
     */
    public static function getHomeTheme()
    {
//        $theme = Common::getConfigValue('sye_theme_home');
        $theme = 'frontend';
        return $theme;
    }

    /**
     * 得到安装程序的主题路径
     */
    public static function getInstallTheme()
    {
//        $theme = Common::getConfigValue('sye_theme_home');
        $theme = 'install';
        return $theme;
    }

    /**
     * 得到前台模块静态资源的路径
     * @param type $path 要传入的path路径
     * @return string F:/webroot/..../statics/resources/frontend...
     */
    public static function getHomePath($path = null)
    {
        $ret = LsYii::getAlias('@webroot/statics/resources/frontend');
        if ($path !== null)
        {
            return $ret . $path;
        }
        return $ret;
    }

    /**
     * 得到前台静态资源的路径
     * @param string $url 要传入的url路径
     * @return string /statics/resources/frontend...
     */
    public static function getHomeUrl($url = null)
    {
        $ret = LsYii::getAlias('@web/statics/resources/frontend');
        if ($url !== null)
        {
            return $ret . $url;
        }
        return $ret;
    }
    
    /**
     * 得到后台模块静态资源的路径
     * @param type $path 要传入的path路径
     * @return string F:/webroot/..../statics/resources/backend...
     */
    public static function getAdminPath($path = null)
    {
        $ret = LsYii::getAlias('@webroot/statics/resources/backend');
        if ($path !== null)
        {
            return $ret . $path;
        }
        return $ret;
    }

    /**
     * 得到后台静态资源的路径
     * @param string $url 要传入的url路径
     * @return string /statics/resources/frontend...
     */
    public static function getAdminUrl($url = null)
    {
        $ret = LsYii::getAlias('@web/statics/resources/backend');
        if ($url !== null)
        {
            return $ret . $url;
        }
        return $ret;
    }

    /**
     * 得到安装的模块静态资源的路径
     * @param string $path 要传入的path路径 
     * @return  string F:/webroot/..../statics/resources/install...
     */
    public static function getInstallPath($path = null)
    {
        $ret = LsYii::getAlias('@webroot/statics/resources/install');
        if ($path !== null)
        {
            return $ret . $path;
        }
        return $ret;
    }

    /**
     * 得到安装模块静态资源的url地址
     * @param string $url 要传入的url路径 
     * @return  string /statics/resources/install...
     */
    public static function getInstallUrl($url = null)
    {
        $ret = LsYii::getAlias('@web/statics/resources/install');
        if ($url !== null)
        {
            return $ret . $url;
        }
        return $ret;
    }
    
    /**
     * 得到安装的模块静态资源的路径
     * @param string $path 要传入的path路径 
     * @return  string F:/webroot/..../statics/resources/install...
     */
    public static function getCommonPath($path = null)
    {
        $ret = LsYii::getAlias('@webroot/statics/resources/common');
        if ($path !== null)
        {
            return $ret . $path;
        }
        return $ret;
    }

    /**
     * 得到安装模块静态资源的url地址
     * @param string $url 要传入的url路径 
     * @return  string /statics/resources/install...
     */
    public static function getCommonUrl($url = null)
    {
        $ret = LsYii::getAlias('@web/statics/resources/common');
        if ($url !== null)
        {
            return $ret . $url;
        }
        return $ret;
    }

}
