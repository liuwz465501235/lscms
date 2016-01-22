<?php
/**
 * 公用类
 * @author Weizhong Liu<liuweizhong4655@gmail.com>
 * @since 1.0
 * @date 1/16/2016
 */
namespace source\libs;

use yii\web\UploadedFile;
use source\models\Config;
use source\libs\Constants;
use source\LsYii;

class Common
{

    /**
     * 检测用户是否执行了安装程序[在登录前台和后台]
     * @param array $config 传入的配置文件
     */
    public static function checkInstall($config)
    {
        $installfile = Constants::getCommonUrl(Constants::InstallFile_Url);
        if (!file_exists($installfile) || !isset($config['components']['db']['class']))
        {
            exit('<script>top.location.href="install.php"</script>');
        }
    }

    /**
     * 检测用户是否已经完成了安装程序[在登录安装模块时]
     * @return 返回是否已经完成了安装，如果完成了安装则返回true，否则则返回false
     */
    public static function checkIsInstalled()
    {
        $installfile = Constants::getCommonUrl( Constants::InstallFile_Url );
        $db = LsYii::getApp()->components['db'];
        if( file_exists($installfile) && isset($db['class']) && !empty($db['class']))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * 获取系统配置的值
     * @param string $key 系统配置的键
     * @param boolean $fromCache 是否从缓存中读取
     * @return string $name 系统配置的值
     */
    public static function getConfigValue($key, $fromCache = true)
    {
        return \common\models\Config::getConfig($key);
    }

    /**
     * 字节单位的转换
     * @param type $bytes 字节数
     * @return type 带单位的大小数据
     */
    public static function HumanSize($bytes)
    {
        $arr = array('B', 'KB', 'MB', 'GB', 'TB');
        $index = 0;
        while ($bytes >= 1024)
        {
            $bytes = $bytes / 1024;
            $index++;
        }
        return is_integer($bytes) ? $bytes . $arr[$index] : number_format($bytes, 2) . $arr[$index];
    }

}
