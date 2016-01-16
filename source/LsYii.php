<?php

/**
 * 整站系统的基类
 * @author Weizhong Liu<liuweizhong4655@gmail.com>
 * @since 1.0
 * @date 1/4/2016
 */

namespace source;

use yii;
use yii\helpers\VarDumper;
use yii\helpers\Url;
use yii\data\Pagination;


class LsYii extends Yii
{

    /**
     * 应用的实例对象
     * @return type
     */
    public static function getApp()
    {
        return self::$app;
    }

    /**
     * 返回视图对象
     * @return type
     */
    public static function getView()
    {
        $app = self::getApp();
        return $app->getView();
    }

    /**
     * 返回请求的应用组件
     * @return type
     */
    public static function getRequest()
    {
        $app = self::getApp();
        return $app->request;
    }

    /**
     * 返回响应的应用组件
     * @return type
     */
    public static function getResponse()
    {
        $app = self::getApp();
        return $app->response;
    }
    
    /**
     * 得到当前的控制器
     * @return type
     */
    public static function getControllerId()
    {
        $app = self::getApp();
        return $app->controller->id;
    }
    
    /**
     * 得到当前的方法
     * @return type
     */
    public static function getActionId()
    {
        $app = self::getApp();
        return $app->controller->action->id;
    }

    /**
     * 返回请求路径
     * @param type $url
     * @return type
     */
    public static function getBaseUrl($url = null)
    {
        $request = self::getRequest();
        $baseUrl = $request->getBaseUrl();
        if ($url !== null)
        {
            $baseUrl .= $url;
        }
        return $baseUrl;
    }

    /**
     * 返回项目的跟路径
     * @param type $url
     * @return type
     */
    public static function getHomeUrl($url = null)
    {
        $app = self::getApp();
        $homeUrl = $app->getHomeUrl();
        if ($url !== null)
        {
            $homeUrl .= $url;
        }
        return $homeUrl;
    }

    /**
     * 网站的跟路径
     * @param type $url
     * @return type
     */
    public static function getWebUrl($url = null)
    {
        $webUrl = self::getAlias('@web');
        if ($url !== null)
        {
            $webUrl .= $url;
        }
        return $webUrl;
    }

    /**
     * 网站的根目录
     * @param type $path
     * @return type
     */
    public static function getWebPath($path = null)
    {
        $webPath = self::getAlias('@webroot');
        if($path !== null)
        {
            $webPath .= $path;
        }
        return $path;
    }
    
    /**
     * 获取网站的域名
     */
    public static function getHostInfo() {
        $hostInfo = self::getRequest()->hostInfo;
        return $hostInfo;
    }

    /**
     * 获取param的值
     * @param type $key
     * @param type $defaultValue
     */
    public static function getAppParam($key , $defaultValue = null) 
    {
        $app = self::getApp();
        if(array_key_exists($key, $app->params)) {
            return $app->params[$key];
        }
        return $defaultValue;
    }
    
    /**
     * 设置param的值
     * @param type $array
     */
    public static function setAppParam($array) 
    {
        $app = self::getApp();
        foreach ($array as $key=>$value) {
            $app->params[$key] = $value;
        }
    }
    
    public static function getViewParam($key , $defaultValue = null)
    {
        $view = self::getView();
        if(array_key_exists($key, $view->params)) {
            return $view->params[$key];
        }
        return $defaultValue;
    }
    
    public static function setViewParam($array)
    {
        $view = self::getView();
        foreach($array as $key=>$value) {
            $view->params[$key] = $value;
        }
    }
    
    public static function hasGetValue($key)
    {
        return isset($_GET[$key]);
    }

    /**
     * 
     * @param type $key a OR a/b
     * @param type $defaultValue
     */
    public static function getGetValue($key , $defaultValue = null)
    {
        $data = $_GET;
        
        $keys = explode('/', $key);
        foreach($keys as $key) 
        {
            if(is_array($data) && array_key_exists($key, $data))
            {
                $data = $data[$key];
            }
            else
            {
                return $defaultValue;
            }
        }
        if($data === null) 
        {
            return $defaultValue;
        }
        return $data;
    }
    
    public static function hasPostValue($key)
    {
        return isset($_POST[$key]);
    }
    
    public static function getPostValue($key , $defaultValue = null)
    {
        $data = $_POST;
        
        $keys = explode('/', $key);
        foreach($keys as $key) 
        {
            if(is_array($data) && array_key_exists($key, $data))
            {
                $data = $data[$key];
            }
            else
            {
                return $defaultValue;
            }
        }
        if($data === null) 
        {
            return $defaultValue;
        }
        return $data;
    }
        
    public static function getFlash($key , $default=null) 
    {
        $app = self::getApp();
        $flash = $app->session->getFlash($key , $default);
        if($flash === null)
        {
            $flash = [];
        }
        if(is_string($flash))
        {
            $flash = [$flash];
        }
        return $flash;
    }
    
    public static function setFlash($key , $message , $append=true) 
    {
        if($append) 
        {
            $flash = self::getFlash($key);
            if(is_string($message))
            {
                $flash[] = $message;
            }
            else if (is_array($message))
            {
                $flash = array_merge($flash , $message);
            }
            else if($message === NULL)
            {
                $flash = null;
            }
            $message = $flash;
        }   
        $app = self::getApp();
        $app->session->setFlash($key , $message);
    }
    
    public static function setWarningMessage($message) 
    {
        return self::setFlash("warning", $message);
    }
    
    public static function setSuccessMessage($message)
    {
        return self::setFlash("success", $message);
    }
    
    public static function setErrorMessage($message)
    {
        return self::setFlash("error", $message);
    }
    
    public static function error($message , $category = 'application')
    {
        parent::error($message, $category);
        return self::setErrorMessage($message);
    }
    
    public static function warning($message, $category = 'application')
    {
        parent::warning($message, $category);
        self::setWarningMessage($message);
    }
    
    public static function info($var, $category = 'application')
    {
        $dump = VarDumper::dumpAsString($var);
        parent::info($dump, $category);
    }
    
    public static function debug($var, $category = 'application')
    {
        $dump = VarDumper::dumpAsString($var);
        parent::info($dump, $category);
    }
    
    public static function getCache($key)
    {
        $cache = self::getApp()->cache;
        return $cache->get($key);
    }
    
    public static function setCache($key, $value, $duration = 0, $dependency = null)
    {
        $cache = self::getApp()->cache;
        return $cache->set($key, $value,$duration,$dependency);
    }
    
    public static function deleteCache($key)
    {
        $cache = self::getApp()->cache;
        $cache->delete($key);
    }
    
    public static function flushCache()
    {
        $cache = self::getApp()->cache;
        $cache->flush();
    }
    
    public static function getUser()
    {
        $app = self::getApp();
        return $app->user;
    }
    
    public static function getIdentity() 
    {
        $app = self::getApp();
        $identity = $app->user->identity;
        if(empty($identity))
        {
            $identity = new \source\models\User();
        }
        return $identity;
    }
    
    public static function getIsGuest()
    {
        $app = self::getApp();
        return $app->user->isGuest;
    }
    
    public static function checkIsGuest($loginUrl = null)
    {
        $app = self::getApp();
        $isGuest = $app->user->isGuest;
        if($isGuest)
        {
            if($loginUrl === FALSE)
            {
                return FALSE;
            }
            if($loginUrl === NULL)
            {
                $loginUrl = [
                    'site/login'
                ];
            }
            return $app->getResponse()->redirect(Url::to($loginUrl) , 302);
        }
        return true;
    }
    
    public static function checkAuth($permissionName, $params = [], $allowCaching = true)
    {
        $app = self::getApp();
        return $app->user->can($permissionName, $params, $allowCaching);
    }
    
    public static function getDb()
    {
        $app = self::getApp();
        return $app->db;
    }
    
    public static function createCommand($sql = null)
    {
        $db = self::getDb();
        if($sql !== null)
        {
            return $db->createCommand($sql);
        }
        return $db->createCommand();
    }
    
    public static function execute($sql)
    {
        $command = self::createCommand($sql);
        return $command->execute();
    }
    
    public static function queryAll($sql)
    {
        $command = self::createCommand($sql);
        return $command->queryAll();
    }
    
    public static function queryOne($sql)
    {
        $command = self::createCommand($sql);
        return $command->queryOne();
    }
    
    public static function getPagedRows($query , $config = [])
    {
        $db = isset($config['db'])?$config['db']:null;
        
        $cloneQuery = clone $query;
        $pager = new Pagination([
            'totalCount'=>$cloneQuery->count('*' , $db)
        ]);
        if(isset($config['page']))
        {
            $pager->setPage($config['page'], true);
        }
        if(isset($config['pageSize']))
        {
            $pager->setPageSize($config['pageSize'], true);
        }
        $rows = $query->offset($pager->offset)->limit($pager->limit);
        if(isset($config['orderBy']))
        {
            $rows = $rows->orderBy($config['orderBy']);
        }
        $rows = $rows->all($db);
        $rowsLable = isset($config['rows']) ? $config['rows'] : 'rows';
        $pagerLable = isset($config['pager']) ? $config['pager'] : 'pager';
        
        $ret = [];
        $ret[$rowsLable] = $rows;
        $ret[$pagerLable] = $pager;
		
        return $ret;
    }
    
//    public static function getService($id)
//    {
//        $id=$id.'Service';
//    $component = self::$app->get($id,true);
//        if( $component instanceof ModuleService)
//        {
//            return  $component;
//        }
//        InvalidParamException("get service:$id");
//    }
    
    public static function go($url)
    {
        $url=Url::to($url);
        exit('<script>top.location.href="'.$url.'"</script>');
    }
    
    public static function gT($message) {
        return \Yii::t('app', $message);
    }
}
