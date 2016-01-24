<?php

namespace source\modules\dict\models;

use Yii;

/**
 * This is the model class for table "{{%dict_category}}".
 *
 * @property string $id
 * @property string $name
 * @property string $description
 */
class DictCategory extends \source\core\base\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%dict_category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'name'], 'required'],
            [['id', 'name'], 'string', 'max' => 64],
            [['description'], 'string', 'max' => 512],
            [['id'], 'unique' , 'on'=>'create']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '标识',
            'name' => '名称',
            'description' => '描述',
        ];
    }
    
    /**
     * 获取分类字典的名称
     * @param type $id
     * @return type
     */
    public static function getDictCategoryName($id)
    {
        $model = self::findOne(['id'=>$id]);
        return empty($model) ? "" : $model->name;
    }
}
