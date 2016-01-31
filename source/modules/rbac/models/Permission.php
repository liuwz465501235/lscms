<?php

namespace source\modules\rbac\models;

use Yii;
use source\LsYii;
use source\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%auth_permission}}".
 *
 * @property string $id
 * @property string $category
 * @property string $name
 * @property string $description
 * @property integer $form
 * @property string $options
 * @property string $default_value
 * @property string $rule
 * @property integer $sort_num
 */
class Permission extends \source\core\base\BaseActiveRecord
{
    const Category_Controller = 'controller';   //控制器权限
    const Category_System = 'system';   //系统权限
    public static function getCategoryItems($key = null)
    {
        $items = [
            self::Category_Controller => '控制器权限',
            self::Category_System => '系统权限'
        ];
                
        return ArrayHelper::getItems($items, $key);
    }

    const Form_Boolean = 1; //布尔型
    const Form_Input = 2;   //单行输入框
    const Form_Textarea = 3;    //多行输入框
    const Form_RadioList = 4;   //单选
    const Form_CheckboxList = 5;    //多选
    public static function getFormItems($key = null)
    {
        $items = [
            self::Form_Boolean => '布尔型',
            self::Form_Input => '单选输入框',
            self::Form_Textarea => '多行输入框',
            self::Form_RadioList => '单选',
            self::Form_CheckboxList => '多选'
        ];
        return ArrayHelper::getItems($items, $key);
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%auth_permission}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category', 'name', 'form'], 'required'],
            [['form', 'sort_num'], 'integer'],
            [['options', 'default_value'], 'string'],
            [['id', 'category', 'name', 'rule'], 'string', 'max' => 64],
            [['description'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '标识',
            'category' => '所属分类',
            'name' => '名称',
            'description' => '备注',
            'form' => '表单类型',
            'default_value' => '默认值/选项',
            'sort_num' => '排序',
            'rule'=>'使用规则',
        ];
    }
    
    public static function setMenus($category = 'system')
    {
        if($category == 'controller')
        {
            $sideMenu = 47;
        }
        else
        {
            $sideMenu = 48;
        }
        $item = self::getCategoryItems($category);
        LsYii::getApp()->controller->setMenus($sideMenu , $item);
    }
}
