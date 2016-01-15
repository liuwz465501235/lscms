<?php

namespace source\helpers;

use source\LsYii;

class FileHelper extends \yii\helpers\FileHelper
{
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
    
    public static function isDir($path) {
        return is_dir($path);
    }
    
    public static function canWrite($file)
    {
        return is_writable($file);
    }
    
    public static function writeArray($file, $array)
    {
        $str = var_export($array, TRUE);
        $str = '<?php return ' . $str . ' ;?>';
        file_put_contents($file, $str);
    }
    
    public static function exist($path) 
    {
        if( is_array($path) )
        {
            $path = self::buildPath($path);
        }
        $path = self::normalizePath($path);
        return file_exists($path);
    }
}
