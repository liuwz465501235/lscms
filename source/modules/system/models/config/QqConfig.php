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
class QqConfig extends BackConfigModel
{
    public $qq_appid;
    public $qq_appkey;
    public $qq_enable;


    public function init()
    {
        parent::init();
        $this->qq_enable = Constants::Third_Login_Status_Open;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['qq_appid','qq_appkey' , 'qq_enable'], 'required'],
            [['qq_appid','qq_appkey'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'qq_appid'=>'APP ID',
            'qq_appkey'=>'APP KEY',
            'qq_enable'=>'是否开启'
        ];
    }
}
