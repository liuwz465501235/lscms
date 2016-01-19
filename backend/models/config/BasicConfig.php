<?php
/**
 * 后台基础配置的模型
 * @author Weizhong Liu<liuweizhong4655@gmail.com>
 * @since 1.0
 * @date 1/16/2016
 */
namespace backend\models\config;

use source\LsYii;
use backend\models\BackConfigModel;
use common\models\Config;


/**
 * This is the model class for table "{{%config}}".
 *
 * @property string $id
 * @property string $key
 * @property string $value
 */
class BasicConfig extends BackConfigModel
{
    public $site_name;  //网站名称
    public $site_description;   //网站描述
    public $site_domain;    //网站域名
    public $site_email;    //网站邮箱
    public $site_language;  //网站语言类型
    public $sys_icp;  //网站备案号
    public $site_about;  //关于网站
    public $site_status;    //网站状态

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['site_name','site_domain','site_email','site_language','site_status'], 'required'],
            [['site_name','site_description','site_domain','site_email','site_language','sys_icp','site_about'], 'string'],
            [['site_status'],'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'site_name' => LsYii::gT('Site Name' , 'field'),
            'site_description' => LsYii::gT('Site Description' , 'field'),
            'site_domain' => LsYii::gT('Site Domain' , 'field'),
            'site_email' => LsYii::gT('Site Email' , 'field'),
            'site_language' => LsYii::gT('Site Language' , 'field'),
            'sys_icp' => LsYii::gT('Site Icp' , 'field'),
            'site_about' => LsYii::gT('Site About' , 'field'),
            'site_status' => LsYii::gT('Site Status' , 'field'),
        ];
    }
}
