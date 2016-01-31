<?php

namespace source\modules\rbac\models;

use Yii;

/**
 * This is the model class for table "{{%auth_category}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $type
 * @property integer $sort_num
 */
class AuthCategory extends \source\core\base\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%auth_category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'type', 'sort_num'], 'required'],
            [['type', 'sort_num'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['description'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'type' => 'Type',
            'sort_num' => 'Sort Num',
        ];
    }
}
