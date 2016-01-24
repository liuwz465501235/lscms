<?php

namespace source\modules\category\models;

use Yii;
use source\LsYii;
use source\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%category}}".
 *
 * @property string $id
 * @property string $name
 * @property string $url
 * @property integer $root
 * @property integer $lft
 * @property integer $rgt
 * @property integer $pid
 * @property integer $level
 * @property string $pic
 * @property string $position
 * @property integer $if_show
 * @property integer $if_delete
 * @property string $memo
 * @property integer $sort
 */
class Category extends \source\core\base\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['if_show','if_delete', 'sort'], 'integer'],
            [['name'], 'required'],
            [['memo'], 'string'],
            [['name'], 'string', 'max' => 100],
            [['url', 'pic'], 'string', 'max' => 255],
            [['position'], 'string', 'max' => 45],
            [['root', 'pid' , 'lft','rgt' , 'level'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键id',
            'name' => '分类名称',
            'url' => '分类地址',
            'root' => '根节点',
            'lft' => '左值',
            'rgt' => '右值',
            'pid' => '父节点的id',
            'level' => '节点所在的级别',
            'pic' => '图片',
            'position' => '位置',
            'if_show' => '是否显示',
            'if_delete' => '允许删除',
            'memo' => '备注',
            'sort' => '排序',
        ];
    }
    
    /**
     * 获取分类树形结构的数据
     * @param type $pid
     * @param type $l
     * @param type $expanded
     * @param type $hasChildren
     * @param type $htmlOptions
     * @return array
     */
    public static function getTreeData($root , $pid , $expanded=false , $hasChildren=false , $htmlOptions=array())
    {
        if($root)
            $model = self::find()->andWhere(['`root`'=>$root])->addOrderBy('`sort` ASC')->all();
        else
            $model = self::find ()->addOrderBy ('`sort` ASC')->all();
        return parent::getTreeDataInternal($model, $pid, $expanded, $hasChildren, $htmlOptions);
    }
    
    /**
     * 取出最右边的最大值
     * @return type
     */
    public static function getMaxRgt() 
    {
        $model = self::find()->addOrderBy('`rgt` DESC')->limit(1)->one();
        return $model ? $model->rgt : 0;
    }
    
    /**
     * 生成json格式
     * @return type
     */
    public static function getToJson()
    {
        return parent::getToJsonInternal();
    }
    
    /**
     * 获取一级菜单
     */
    public static function getTopCategory()
    {
        $model = self::find()->where(['pid'=>0])->addOrderBy('sort')->all();
        return $model;
    }
    /**
     * 获取分类切换列表
     * @param type $defaultId
     * @return type
     */
    public static function getItems($defaultId , $url)
    {
        $model = self::getTopCategory();
        return parent::getItemsInternal($model , $defaultId , $url);
    }
    
    public static function getCategorysArray($pid)
    {
        $model = self::find()->andWhere(['pid'=>$pid])->all();
        return ArrayHelper::map($model, 'id', 'name');
    }
    
}
