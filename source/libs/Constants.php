<?php
/**
 * 系统常量表
 * @author Weizhong Liu <liuweizhong4655@gmail.com>
 * @since 1.0
 * @date 1/16/2016
 */
namespace source\libs;

use Yii;
use source\helpers\ArrayHelper;

class Constants
{
    const TABSIZE = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
    
    //是与否
    const YesNo_Yes = 1;
    const YesNo_No = 0;
    public static function getYesNoItems($key = null)
    {
        $items = [
            self::YesNo_Yes => '是',
            self::YesNo_No => '否'
        ];
        return ArrayHelper::getItems($items , $key);
    }
    
    //用户状态
    const Status_Enable = 1;
    const Status_Desable = 0;
    public static function getStatusItems($key = null)
    {
        $items = [
            self::Status_Enable => '可用', 
            self::Status_Desable => '禁用'
        ];
        return ArrayHelper::getItems($items, $key);
    }
    
    //性别
    const UserSex_Man = 1;
    const UserSex_Woman = 2;
    const UserSex_Secret = 3;
    public static function getUserSexItems($key = null)
    {
        $items = [
            self::UserSex_Man => '男',
            self::UserSex_Woman => '女',
            self::UserSex_Secret => '保密'
        ];
        return ArrayHelper::getItems($items, $key);
    }
    
    //设置常用的路径
    const InstallFile_Url = 1;  //安装文件的路径
    public static function getCommonUrl($key = null) {
        $items = [
            self::InstallFile_Url => \Yii::getAlias('@data') . '/install.lock'
        ];
        return ArrayHelper::getItems($items, $key);
    }
    
    //网站状态
    const WebSite_Status_open = 1;  //开启
    const WebSite_status_close = 0; //关闭
    public static function getWebSiteStatus($key = null)
    {
        $items = [
            self::WebSite_Status_open => '开启',
            self::WebSite_status_close => '关闭'
        ];
        return ArrayHelper::getItems($items, $key);
    }
    
    //菜单状态
    const Menu_Status_Show = 1; //显示
    const Menu_status_hide = 0; //隐藏
    public static function getMenuStatus($key = null)
    {
        $items = [
            self::Menu_Status_Show => '显示',
            self::Menu_status_hide => '隐藏'
        ];
        return ArrayHelper::getItems($items, $key);
    }
}
