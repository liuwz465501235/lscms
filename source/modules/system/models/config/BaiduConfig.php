<?php
/**
 * 后台主题配置的模型
 * @author Weizhong Liu<liuweizhong4655@gmail.com>
 * @since 1.0
 * @date 1/20/2016
 */
namespace source\modules\system\models\config;

use source\LsYii;
use source\modules\system\models\BackConfigModel;
use source\models\Config;
use source\libs\Constants;


/**
 * This is the model class for table "{{%config}}".
 *
 * @property string $id
 * @property string $key
 * @property string $value
 */
class BaiduConfig extends BackConfigModel
{
    public $baidu_appid;
    public $baidu_appkey;
    public $baidu_enable;


    public function init()
    {
        parent::init();
        $this->baidu_enable = Constants::Third_Login_Status_Open;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['baidu_appid','baidu_appkey' , 'baidu_enable'], 'required'],
            [['baidu_appid','baidu_appkey'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'baidu_appid'=>'APP ID',
            'baidu_appkey'=>'APP KEY',
            'baidu_enable'=>'是否开启'
        ];
    }
}
