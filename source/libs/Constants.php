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
    
    //分类状态
    const Category_Status_Show = 1; //显示
    const Category_status_hide = 0; //隐藏
    public static function getCategoryStatus($key = null)
    {
        $items = [
            self::Category_Status_Show => '显示',
            self::Category_status_hide => '隐藏'
        ];
        return ArrayHelper::getItems($items, $key);
    }
    
    //时间格式
    const DateTime_Time_Format_24 = 24; //24小时制
    const DateTime_Time_Format_12 = 12; //12小时制
    public static function getDateTimeTimeFormat($key = null)
    {
        $items = [
            self::DateTime_Time_Format_24 => '24小时制',
            self::DateTime_Time_Format_12 => '12小时制'
        ];
        return ArrayHelper::getItems($items, $key);
    }
    
    //允许删除选项
    const If_Delete_Allow = 1;  //允许删除
    const If_Delete_Prohibit = 0;   //禁止删除
    public static function getIfDelete($key = null)
    {
        $item = [
            self::If_Delete_Allow => '允许',
            self::If_Delete_Prohibit => '禁止'
        ];
        return ArrayHelper::getItems($items, $key);
    }
    
    //是否是系统配置
    const Is_System_Yes = 1;    //是系统配置
    const Is_System_No = 0; //非系统配置
    public static function getIsSystem($key = null)
    {
        $item = [
            self::Is_System_Yes => '是',
            self::Is_System_No => '非',
        ];
        return ArrayHelper::getItems($items, $key);
    }
    
    //字典状态
    const Dict_Status_Enable = 1;   //可用
    const Dict_Status_Deable = 0;   //禁用
    public static function getDictStatus($key = null)
    {
        $items = [
            self::Dict_Status_Enable => '可用',
            self::Dict_Status_Deable => '禁用'
        ];
        return ArrayHelper::getItems($items, $key);
    }
    
    //第三方登录的状态
    const Third_Login_Status_Open = 1;  //开启
    const Third_Login_Status_Close = 0; //关闭
    public static function getThirdLoginStatus($key = null)
    {
        $items = [
            self::Third_Login_Status_Open => '开启',
            self::Third_Login_Status_Close => '关闭'
        ];
        return ArrayHelper::getItems($items, $key);
    }
}
