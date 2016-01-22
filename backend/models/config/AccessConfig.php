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
class AccessConfig extends BackConfigModel
{
    public $allow_register;

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
