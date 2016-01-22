<?php
/**
 * 后台主题配置的模型
 * @author Weizhong Liu<liuweizhong4655@gmail.com>
 * @since 1.0
 * @date 1/20/2016
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
class ThemeConfig extends BackConfigModel
{
    public $home_theme;
    public $admin_theme;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['home_theme','admin_theme'], 'required'],
            [['home_theme','admin_theme'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'home_theme' => LsYii::gT('Home Theme' , 'field'),
            'admin_theme' => LsYii::gT('Admin Theme' , 'field'),
        ];
    }
    
    /**
     * 前台主题的列表
     * @return type
     */
    public static function getHomeItems()
    {
        return [
            'default'=>'默认主题'
        ];
    }
    
    /**
     * 后台主题列表
     * @return type
     */
    public static function getAdminItems()
    {
        return [
            'default'=>'默认主题',
        ];
    }
}
