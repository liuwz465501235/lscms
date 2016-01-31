<?php

namespace source\modules\rbac\models;

use source\LsYii;
use source\libs\Constants;
use source\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%auth_role}}".
 *
 * @property string $id
 * @property string $category
 * @property string $name
 * @property string $description
 * @property integer $is_system
 */
class Role extends \source\core\base\BaseActiveRecord
{
    const Category_System = 'system';
    const Category_Admin = 'admin';
    const Category_Member = 'member';
    
    public static function getCategoryItems($key = null)
    {
        $items = [
            self::Category_System => '系统角色',
            self::Category_Admin => '管理员角色',
            self::Category_Member => '会员角色'
        ];
        return \source\helpers\ArrayHelper::getItems($items , $key);
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%auth_role}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category', 'name'], 'required'],
            [['is_system'], 'integer'],
            [['id', 'category', 'name'], 'string', 'max' => 64],
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
            'category' => '分类',
            'name' => '名称',
            'description' => '描述',
            'is_system' => '系统内置',
        ];
    }
    
    public static function getMemberItems($key = null)
    {
        $items = self::getRoleItems( self::Category_Member );
        return ArrayHelper::getItems($items, $key);
    }
    
    public static function getAdminItems($key = null , $type = true)
    {
        $items = self::getRoleItems( self::Category_Admin );
        if($type)
        {
            if(!array_key_exists('administrator', $items))
            {
                $items['administrator'] = '超级管理员';
            }
        }
        else
        {
            if(array_key_exists('administrator', $items))
            {
                unset($items['administrator']);
            }
        }
        return ArrayHelper::getItems($items, $key);
    }
    
    public static function getRoleItems($role)
    {
       $model = self::find()->andWhere(['category'=>$role])->all();
       return empty($model) ? [] : ArrayHelper::map($model, 'id', 'name');
    }

    /**
     * 设置默认菜单
     * @param type $category
     */
    public static function setMenus($category = 'system')
    {
        if($category == 'admin')
        {
            $sideMenu = 18;
        }
        else if($category == 'member')
        {
            $sideMenu = 17;
        }
        else
        {
            $sideMenu = 45;
        }
        $item = Role::getCategoryItems($category);
        \source\LsYii::getApp()->controller->setMenus($sideMenu , $item);
    }
    
    /**
     * 组件角色选项
     * @return type
     */
    public static function buildOptions()
    {
        $ret = [];
        $rows = self::find()->all();
        foreach ($rows as $row)
        {
            $ret[]=['id'=>$row['id'],'name'=>$row['name'],'category'=>self::getCategoryItems($row['category'])];
        }
        return $ret;
    }
}
