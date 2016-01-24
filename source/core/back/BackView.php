<?php
/**
 * 公用视图基类View
 * @author Weizhong Liu<liuweizhong4655@gmail.com>
 * @since 1.0
 * @date 1/16/2016
 */
namespace source\core\back;

use source\core\base\BaseView;
use source\LsYii;
use source\libs\Resource;
use yii\base\Theme;
use source\models\Menu;
use source\helpers\Url;


class BackView extends BaseView
{
    public function init()
    {
        parent::init();
    }
    
    public static function setTheme() {
        $currentTheme = Resource::getAdminTheme();
        $config = [
            'pathMap' => [
                '@backend/views'=>[
                    "@statics/themes/backend/{$currentTheme}/views"
                ],
            ], 
            'baseUrl' => "@statics/themes/backend/{$currentTheme}"
        ];
        LsYii::getView()->theme = new Theme($config);
    }
    
    /**
     * 生成面包屑
     * @return type
     */
    public static function createBreadcrumbs()
    {
        $topMenu = LsYii::getApp()->controller->topMenu;
        $sideMenu = LsYii::getApp()->controller->sideMenu;
        $lastBreadcrumb = LsYii::getApp()->controller->lastBreadcrumb;
        
        if($topMenu)
            $tModel = Menu::getMenu($topMenu);  //后台一级菜单
        if($sideMenu)
            $sModel = Menu::getMenu($sideMenu); //后台三级菜单
        //获取其中的二级菜单
        if(isset($sModel) && !empty($sModel))
            $mModel = Menu::getMenu($sModel->pid);  //获取二级菜单
        if(isset($tModel) && !empty($sModel))
            $tBreadcrumbs = ['label'=>$tModel->name , 'url'=>[$tModel->url]];
        if(isset($mModel) && !empty($mModel))
            $mBreadcrumbs = ['label'=>$mModel->name , 'url'=>[$mModel->url]];
        if(isset($sModel) && !empty($sModel))
            $sBreadcrumbs = ['label'=>$sModel->name , 'url'=>[$sModel->url]];
        $lBreadcrumbs = ['label'=>$lastBreadcrumb];
        $arr[] = isset($tBreadcrumbs) ? $tBreadcrumbs : "";
        $arr[] = isset($mBreadcrumbs) ? $mBreadcrumbs : "";
        $arr[] = isset($sBreadcrumbs) ? $sBreadcrumbs : "";
        $arr[] = isset($lastBreadcrumb) ? ['label'=> LsYii::gT($lastBreadcrumb) ] : "";
        $arr = array_filter($arr);
        return $arr;
    }
}
