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
class DatetimeConfig extends BackConfigModel
{
    public $datetime_timezone;
    public $datetime_date_format;
    public $datetime_time_format;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['datetime_timezone','datetime_date_format','datetime_time_format'], 'required'],
            [['datetime_timezone','datetime_date_format','datetime_time_format'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'datetime_timezone' => LsYii::gT('Datetime Timezone' , 'field'),
            'datetime_date_format' => LsYii::gT('Datetime Date Format' , 'field'),
            'datetime_time_format'=>LsYii::gT('Datetime Time Format' , 'field'),
        ];
    }
}
