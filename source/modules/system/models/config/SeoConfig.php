<?php
/**
 * SEO配置的模型
 * @author Weizhong Liu<liuweizhong4655@gmail.com>
 * @since 1.0
 * @date 1/16/2016
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
class SeoConfig extends BackConfigModel
{
    public $seo_title;  //seo标题
    public $seo_keywords;   //seo关键字
    public $seo_description;    //seo描述
    public $seo_head;    //其它头信息

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['seo_title','seo_keywords','seo_description'], 'required' , 'message'=>  LsYii::gT('{attribute}cannot be blank')],
            [['seo_title','seo_keywords','seo_description','seo_head'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'seo_title' => LsYii::gT('Seo Title' , 'field'),
            'seo_keywords' => LsYii::gT('Seo Keywords' , 'field'),
            'seo_description' => LsYii::gT('Seo Description' , 'field'),
            'seo_head' => LsYii::gT('Seo Head' , 'field'),
        ];
    }
}
