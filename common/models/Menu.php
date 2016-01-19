<?php

namespace common\models;

use Yii;
use source\LsYii;
use source\libs\Pinying;
use \source\libs\Constants;

/**
 * This is the model class for table "{{%menu}}".
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
 * @property string $memo
 * @property integer $sort
 */
class Menu extends \source\core\base\BaseActiveRecord
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
            [['if_show', 'sort'], 'integer'],
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
            'name' => '菜单名称',
            'url' => '菜单地址',
            'root' => '根节点',
            'lft' => '左值',
            'rgt' => '右值',
            'pid' => '父节点的id',
            'level' => '节点所在的级别',
            'pic' => '图片',
            'position' => '位置',
            'if_show' => '是否显示',
            'memo' => '备注',
            'sort' => '排序',
        ];
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
     * 获取菜单树形结构的数据
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
     * 获取后台的顶部菜单
     * @param type $pid
     * @return type
     */
    public static function getTopMenu($pid=1)
    {
        $items = array();
        $model = self::find()->andWhere(['`pid`'=>$pid , '`if_show`'=>Constants::Menu_Status_Show])->addOrderBy('`sort` ASC')->all();
        if($model) foreach($model as $md)
        {
            $item['label'] = $md->name;
            $item['url'] = \source\helpers\Url::to([$md->url]);
            if(LsYii::getApp()->controller->topMenu == $md->id)
            {
                $item['active'] = true;
            }
            else
            {
                $item['active'] = false;
            }
            $items[] = $item;
        }
        return $items;
    }
}
