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


/**
 * This is the model class for table "{{%config}}".
 *
 * @property string $id
 * @property string $key
 * @property string $value
 */
class AccessConfig extends BackConfigModel
{
    public $allow_register;
    
    public function init()
    {
        parent::init();
        $this->allow_register = 1;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['allow_register'], 'required'],
            [['allow_register'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'allow_register' => LsYii::gT('Allow Register' , 'field'),
        ];
    }
}
