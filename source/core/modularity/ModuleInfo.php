<?php
/**
 * 模块信息的类
 * @author Weizhong Liu<liuweizhong4655@gmail.com>
 * @version 1.0
 * @date 1/21/2015
 */
namespace source\core\modularity;

use source\LsYii;

class ModuleInfo extends \yii\base\Object
{
    /**
     * 模块id
     * @var type 
     */
    public $id;
    /**
     * 模块名称
     * @var type 
     */
    public $name;
    /**
     * 模块版本
     * @var type 
     */
    public $version;
    /**
     * 模块描述
     * @var type 
     */
    public $description;
    /**
     * 模块Url地址
     * @var type 
     */
    public $url;
    
    public $author;
    
    public $author_url;
    /**
     * 是否是系统内置
     * @var type 
     */
    public $is_system = false;
    
    public $is_content;
    
    /**
     * 安装
     */
    public function install()
    {
        
    }
    /**
     * 卸载 
     */
    public function uninstall()
    {
        
    }
    /**
     * 升级 
     */
    public function upgrader()
    {
        
    }
    /**
     * 启用后台
     */
    public function activeAdmin()
    {
        
    }
    /**
     * 关闭后台
     */
    public function deactiveAdmin()
    {
        
    }
    /**
     * 启用前台
     */
    public function activeHome()
    {
        
    }
    /**
     * 关闭前台
     */
    public function deactiveHome()
    {
        
    }
}