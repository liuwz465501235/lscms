<?php
namespace source\libs;

use source\LsYii;
class Utility
{
    public static function checkServerVar()
    {
        $missing=[];
        $vars=['HTTP_HOST','SERVER_NAME','SERVER_PORT','SCRIPT_NAME','SCRIPT_FILENAME','PHP_SELF','HTTP_ACCEPT','HTTP_USER_AGENT'];
        foreach($vars as $var)
        {
            if(!isset($_SERVER[$var]))
                $missing[]=$var;
        }
        if(!empty($missing))
            return '$_SERVER缺少{vars}。';
        /* if(realpath($_SERVER["SCRIPT_FILENAME"]) !== realpath(__FILE__))
         return '$_SERVER["SCRIPT_FILENAME"]必须与入口文件路径一致。';*/
    
        if(!isset($_SERVER["REQUEST_URI"]) && isset($_SERVER["QUERY_STRING"]))
            return '$_SERVER["REQUEST_URI"]或$_SERVER["QUERY_STRING"]必须存在。';
        if(!isset($_SERVER["PATH_INFO"]) && strpos($_SERVER["PHP_SELF"],$_SERVER["SCRIPT_NAME"]) !== 0)
            return '无法确定URL path info。请检查$_SERVER["PATH_INFO"]（或$_SERVER["PHP_SELF"]和$_SERVER["SCRIPT_NAME"]）的值是否正确。';
        return 'ok';
    }
    
    public static function checkCaptchaSupport()
    {
        if(extension_loaded('imagick'))
        {
            $imagick=new \Imagick();
            $imagickFormats = $imagick->queryFormats('PNG');
            if(in_array('PNG',$imagickFormats))
            {
                return 'ok';
            }
        }
        if(extension_loaded('gd'))
        {
            $gdInfo = gd_info();
            if($gdInfo['FreeType Support'])
            {
                return 'ok';
            }
            return 'GD 库已安装,<br />FreeType 未安装';
        }
        
        return 'GD or ImageMagick 均未安装';
    }
}
