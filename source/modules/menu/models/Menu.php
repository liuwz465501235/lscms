<?php

namespace source\modules\menu\models;

use Yii;
use source\LsYii;
use source\libs\Pinying;
use source\libs\Constants;
use source\helpers\Url;

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
 * @property integer $if_delete
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
            [['if_show', 'if_delete', 'sort'], 'integer'],
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
            'if_delete' => '允许删除',
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
    
    /**
     * 得到后台侧边的菜单栏
     */
    public static function getSideMenu()
    {
        $html = '';
        $topMenu = LsYii::getApp()->controller->topMenu;
        if(!isset($topMenu) || empty($topMenu))
            return $topMenu;
        //查询三级菜单
        $menus = self::getMenuArray($topMenu, 3);
        if($menus) {
            $html .= '<div class="sidebar">';
            $html .= '<div id="subnav" class="subnav">';
            foreach($menus as $menu)
            {
                $html .= '<h3><i class="icon"></i>'. $menu->name .'</h3>';
                //查询四级子菜单
                $childMenus = self::getMenuArray($menu->id, 4);
                if($childMenus)
                {
                    $html .= '<ul class="side-sub-menu subnav-off">';
                    foreach($childMenus as $childMenu)
                    {
                        if(LsYii::getApp()->controller->sideMenu == $childMenu->id)
                            $class = 'class="active"';
                        else
                            $class = '';
                        $html .= '<li '.$class.'><a class="item" href="'. Url::to([$childMenu->url]) .'">'. $childMenu->name .'</a></li>';
                    }
                    $html .= '</ul>';
                }
            }
            $html .= '</div>';
            $html .= '</div>';
        }
        return $html;
    }
    
    /**
     * 获取每一级菜单的数组
     * @param type $pid
     * @param type $level
     * @return type
     */
    public static function getMenuArray($pid , $level)
    {
        return self::find()->andWhere(['`pid`'=>$pid , '`level`'=>$level])->addOrderBy('`sort` ASC')->all();
    }
    
    /**
     * 得到菜单项
     * @param type $id
     * @return type
     */
    public static function getMenu($id = null)
    {
        if($id === null)
        {
            $model = Menu::find()->all();
        }
        else
        {
            $model = Menu::findOne(['id'=>$id]);
        }
        return $model;
    }
    
    /**
     * 获取一级菜单
     */
    public static function getOneMenu()
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
        $model = self::getOneMenu();
        return parent::getItemsInternal($model , $defaultId , $url);
    }
}
