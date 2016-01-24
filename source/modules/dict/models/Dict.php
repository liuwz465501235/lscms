<?php

namespace source\modules\dict\models;

use Yii;
use source\LsYii;

/**
 * This is the model class for table "{{%dict}}".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $category_id
 * @property string $name
 * @property string $value
 * @property string $description
 * @property string $thumb
 * @property integer $status
 * @property integer $sort
 */
class Dict extends \source\core\base\BaseActiveRecord
{
    const Dict_Category_Id = 2;
    
    public function init()
    {
        parent::init();
        if( LsYii::getActionId() != 'index')
        {
            $this->sort = 0;
            $this->parent_id = 0;
            $this->status = \source\libs\Constants::Dict_Status_Enable;
        }
    }

        /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%dict}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'category_id', 'name', 'value'], 'required'],
            [['parent_id', 'status', 'sort'], 'integer'],
            [['value'], 'string'],
            [['category_id', 'name'], 'string', 'max' => 64],
            [['description', 'thumb'], 'string', 'max' => 512]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => LsYii::gT('ID' , 'field'),
            'parent_id' => LsYii::gT('Parent' , 'field'),
            'category_id' => LsYii::gT('Category' , 'field'),
            'name' => LsYii::gT('Name' , 'field'),
            'value' => LsYii::gT('Value' , 'field'),
            'description' => LsYii::gT('Description' , 'field'),
            'thumb' => LsYii::gT('Thumb' , 'field'),
            'status' => LsYii::gT('Status' , 'field'),
            'sort' => LsYii::gT('Sort' , 'field'),
        ];
    }
    
    public static function getDictCategorys()
    {
        $id = self::Dict_Category_Id;
        return Category::getCategorysArray($id);
    }
}
