<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%menu}}".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $category_id
 * @property string $name
 * @property string $url
 * @property string $target
 * @property string $description
 * @property string $thumb
 * @property integer $status
 * @property integer $sort_num
 */
class Menu extends \source\core\back\BackActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%menu}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'category_id', 'name', 'url'], 'required'],
            [['parent_id', 'status', 'sort_num'], 'integer'],
            [['category_id', 'name', 'target'], 'string', 'max' => 64],
            [['url', 'description', 'thumb'], 'string', 'max' => 512]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent ID',
            'category_id' => 'Category ID',
            'name' => 'Name',
            'url' => 'Url',
            'target' => 'Target',
            'description' => 'Description',
            'thumb' => 'Thumb',
            'status' => 'Status',
            'sort_num' => 'Sort Num',
        ];
    }
}
