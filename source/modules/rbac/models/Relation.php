<?php

namespace source\modules\rbac\models;

use Yii;

/**
 * This is the model class for table "{{%auth_relation}}".
 *
 * @property string $role
 * @property string $permission
 * @property string $value
 */
class Relation extends \source\core\base\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%auth_relation}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role', 'permission'], 'required'],
            [['role', 'permission'], 'string', 'max' => 64],
            [['value'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'role' => 'Role',
            'permission' => 'Permission',
            'value' => 'Value',
        ];
    }
}
