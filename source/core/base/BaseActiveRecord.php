<?php
/**
 * 公用模型基类ActiveRecord
 * @author Weizhong Liu<liuweizhong4655@gmail.com>
 * @since 1.0
 * @date 1/16/2016
 */
namespace source\core\base;

use source\LsYii;
use yii\db\ActiveRecord;
use source\libs\Pinying;
use source\helpers\Html;
use \source\helpers\Url;

class BaseActiveRecord extends ActiveRecord
{
    /**
     * 生成表单框架中的json格式
     * @return type
     */
    public static function getToJsonInternal()
    {
        $menus = self::encrytion();
        $pinyin = new Pinying();
        $category = array();
        if($menus) foreach($menus as $menu) {
            $i[$menu['level']] = $menu['name'];
            $name = '';
            for($j=1;$j<=$menu['level'];$j++) {
                $name .= empty($name)?$i[$j]:">".$i[$j];
            }
            $py = $pinyin->Pinyin($menu['name']);
            $initials = $pinyin->Pinyin($menu['name'],true);
            $category[] = array(
                'value' => $menu['id'],
                'condition' => "{$initials} {$py} {$menu['id']} {$name}",
                'name' => $name,
                'text' => $menu['id'] . " " . $name,
            );
        }
        $categoryJson = json_encode($category);
        return $categoryJson;
    }
    
    /**
     * 将所有的菜单父子紧密相连
     */
    public static function encrytion($models=null,$pid=0) 
    {
        $data = array();
        if(is_null($models))
            $models = self::find()->all();
        foreach($models as $model) {
            if($model->pid==$pid) {
                $data[] = $model->attributes;
                $data = array_merge($data , self::encrytion($models,$model->id));
            }
        }
        return $data;
    }
    
    /**
     * 得到格式化的数组
     * @param type $model
     * @param type $pid
     * @param type $expanded
     * @param type $hasChildren
     * @param type $htmlOptions
     * @return array
     */
    public static function getTreeDataInternal($models , $pid , $expanded=false , $hasChildren=false , $htmlOptions=array())
    {
        $data = array();
        if(!$models) 
            return $data;
        foreach($models as $model)
        {
            if($model->pid == $pid)
            {
                $template = Html::beginTag('div', array('class'=>'tree-hover'));
                if(isset($htmlOptions['updateUrl']))
                {
                    $updateUrl = Url::to([$htmlOptions['updateUrl'] , 'id'=>$model->id]);
                    $template .= Html::a($model->name, $updateUrl);
                    $template .= '<span class="pull-right">';
                    $template .= Html::a('<span class="glyphicon glyphicon-edit"></span>', $updateUrl, ['title'=>  LsYii::gT('编辑')]);
                }
                else
                {
                    $template .= $model->name;
                    $template .= '<span class="pull-right">';
                }
                if(isset($htmlOptions['addChildrenUrl']))
                {
                    $addChilderUrl = Url::to([$htmlOptions['addChildrenUrl'] , 'id'=>$model->id]);
                    $template .= Html::a('<span class="glyphicon glyphicon-plus"></span>' , $addChilderUrl , array('title'=>  LsYii::gT('添加子类')));
                }
                if(isset($htmlOptions['deleteUrl']))
                {
                    $deleteUrl = Url::to([$htmlOptions['deleteUrl'] , 'id'=>$model->id]);
                    $template .= Html::a('<span class="glyphicon glyphicon-remove"></span>' , $deleteUrl , array('title'=>  LsYii::gT('删除') , 'data-method'=>'POST'));
                }
                $template .= Html::endTag('div');
                $arr['text'] = $template;
                $arr['expanded'] = $expanded;
                $arr['id'] = $model->id;
                $arr['children'] = self::getTreeDataInternal($models, $model->id, $expanded, $hasChildren, $htmlOptions);
                $data[] = $arr;
            }
        }
        return $data;
    }
    
    public static function getItemsInternal($model , $defaultId , $url)
    {
        if(empty($model))
        {
            return [];
        }
        $data = [];
        foreach($model as $m)
        {
            if($m->if_delete == \source\libs\Constants::If_Delete_Allow)
            {
                $label = '<span style="float:left;margin-right:5px;">'.$m->name.'</span>';
                $label .= '<span class="glyphicon glyphicon-remove attribute-remove" menu-id="2" style="float:left;margin-top:-5px;display:none;"></span>';
            }
            else
            {
                $label = $m->name;
            }
            $data[] = [
                'label'=>$label,
                'active'=>$m->id == $defaultId ? true : false,
                'encode'=>false,
                'url'=>[$url , 'id'=>$m->id],
            ];
        }
        return $data;
    }
}
