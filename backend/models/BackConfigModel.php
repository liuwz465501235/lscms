<?php
/**
 * 后台配置文件模型基类Model
 * @author Weizhong Liu<liuweizhong4655@gmail.com>
 * @since 1.0
 * @date 1/16/2016
 */
namespace backend\models;

use source\LsYii;
use source\core\back\BackModel;
use common\models\Config;

class BackConfigModel extends BackModel
{
    /**
     * 得到属性的key值
     */
    public function getAttributeKeys()
    {
        return $this->attributes();
    }

    /**
     * 保存基本信息
     * @param type $attributes
     * @return type
     */
    public function save($attributes)
    {
        return $this->saveInternal($attributes);
    }
    
    public function initValue()
    {
        $attributes = $this->getAttributeKeys();
        return $this->initValueInternal($this , $attributes );
    }
    
    /**
     * 保存记录
     * @param type $model
     */
    protected static function saveInternal($attributes)
    {
        if($attributes) foreach ($attributes as $key=>$value)
        {
            $cmodel = Config::findOne(['`key`'=>$key]);
            if(!$cmodel)
            {
                $cmodel = new Config();
                $cmodel->key = $key;
                $cmodel->value = $value ? $value : '';
                $cmodel->save();
            }
            else
            {
                if($cmodel->value != $value)
                {
                    $cmodel->value = $value ? $value : '';
                    $cmodel->save();
                }
            }
            if($key == 'site_language')
            {   //设置配置文件
                $configFile = LsYii::getWebPath('/common/config/main-local.php');
                \source\helpers\FileHelper::writeConfig($configFile, ['language'=>$value]);
            }
        }
        return true;
    }
    
    /**
     * 初始使值
     * @param type $model
     * @param type $attributes
     * @return type
     */
    public static function initValueInternal($model , $attributes )
    {
        if($attributes) foreach($attributes as $key)
        {
            $cmodel = Config::findOne(['`key`'=>$key]);
            if($cmodel)
            {
                $model->$key = $cmodel->value;
            }
        }
        return $model;
    }
    
}