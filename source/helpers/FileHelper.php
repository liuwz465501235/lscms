<?php

namespace source\helpers;

use source\LsYii;

class FileHelper extends \yii\helpers\FileHelper
{
    /**
     * 重组文件路径
     * @param type $pathes
     * @param type $withStart
     * @param type $withEnd
     * @return type
     */
    public static function buildPath($pathes, $withStart = false, $withEnd = false)
    {
        $ret = '';
        
        foreach ($pathes as $path)
        {
            $ret .= $path . DIRECTORY_SEPARATOR;
        }
        if ($withStart)
        {
            $ret = DIRECTORY_SEPARATOR . $ret;
        }
        if (! $withEnd)
        {
            $ret = rtrim($ret, DIRECTORY_SEPARATOR);
        }
        return $ret;
    }
    /**
     * 是否是一个目录
     * @param type $path
     * @return type
     */
    public static function isDir($path) {
        return is_dir($path);
    }
    /**
     * 是否可写
     * @param type $file
     * @return type
     */
    public static function canWrite($file)
    {
        return is_writable($file);
    }
    /**
     * 向文件中写入一个数组
     * @param type $file
     * @param type $array
     */
    public static function writeArray($file, $array)
    {
        $str = var_export($array, TRUE);
        $str = '<?php return ' . $str . ' ;?>';
        file_put_contents($file, $str);
    }
    /**
     * 判断文件是否存在
     * @param type $path
     * @return type
     */
    public static function exist($path) 
    {
        if( is_array($path) )
        {
            $path = self::buildPath($path);
        }
        $path = self::normalizePath($path);
        return file_exists($path);
    }
    /**
     * 向配置文件中写入内容
     * @param type $file
     * @param type $array
     */
    public static function writeConfig($file , $array)
    {
        if( !self::exist($file) )
        {
            return null;
        }
        $config = require($file);
        if(empty($config))
        {
            $config = $array;
        }
        else
        {
            $config = array_merge($config , $array);
        }
        return self::writeArray($file, $config);
    }
}
