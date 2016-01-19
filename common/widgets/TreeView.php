<?php

namespace common\widgets;

use source\LsYii;
use source\libs\Common;
use yii\bootstrap\Widget;
use source\helpers\Html;
use source\libs\Resource;

class TreeView extends Widget
{
    /**
     * 展现
     * @var type 
     */
    public $presist = 'cookie';
    /**
     * 是否展开
     * @var type 
     */
    public $collapsed = true;
    /**
     * 是否唯一
     * @var type 
     */
    public $unique = true;
    /**
     * 展开速度
     * @var type 
     */
    public $animated = 'fast';
    /**
     * 最外层节点的属性
     * @var type 
     */
    public $treeOptions = [];
    /**
     * 要展现的数据
     * @var type 
     */
    public $data = [];


    public function init()
    {
        $this->setTreeOptions();    //设置tree的选项
    }
    
    /**
     * 设置treeview初始化选项
     */
    public function setTreeOptions()
    {
        //如果未传入treeOptions的样式或者传入的样式不是一个数组，则赋值被值
        if(!$this->treeOptions || !is_array($this->treeOptions))
        {   
            $this->treeOptions = [
                'id'=>'navigation',
                'class'=>'treeview'
            ];
        }
        else    //如果传入的是个数组
        {
            if(!isset($this->treeOptions['id']))
            {   //如果未传入节点的id
                $this->treeOptions['id'] = 'navigation';
            }
            if(!isset($this->treeOptions['class']))
            {   //如果未传入class
                $this->treeOptions['class'] = 'treeview';
            }
        }
    }
    
    /**
     * 输出html代码
     * @param type $data
     * @return string
     */
    public static function saveDataAsHtml($data)
    {
        $html='';
        if(is_array($data))
        {
                foreach($data as $node)
                {
                        if(!isset($node['text']))
                                continue;

                        if(isset($node['expanded']))
                                $css=$node['expanded'] ? 'collapsable' : 'expandable';
                        else
                                $css='';

                        if(isset($node['hasChildren']) && $node['hasChildren'])
                        {
                                if($css!=='')
                                        $css.=' ';
                                $css.='hasChildren';
                        }

                        $options=isset($node['htmlOptions']) ? $node['htmlOptions'] : array();
                        if($css!=='')
                        {
                                if(isset($options['class']))
                                        $options['class'].=' '.$css;
                                else
                                        $options['class']=$css;
                        }

                        if(isset($node['id']))
                                $options['id']=$node['id'];

                        $html.=Html::beginTag('li', $options);
                        if(isset($node['href']))
                        {
                            $html .= Html::a($node['text'], $node['href']);
                        }
                        else
                        {
                            $html .= $node['text'];
                        }
                        if(!empty($node['children']))
                        {
                                $html.="\n<ul>\n";
                                $html.=self::saveDataAsHtml($node['children']);
                                $html.="</ul>\n";
                        }
                        $html.=Html::endTag('li')."\n";
                }
        }
        return $html;
    }

    public function run()
    {
        $this->registerStatics();
        echo Html::beginTag('ul' , $this->treeOptions);
        echo self::saveDataAsHtml($this->data);
        echo Html::endTag('ul');
    }
    
    /**
     * 加载静态资源
     */
    public function registerStatics()
    {
        LsYii::getView()->registerJsFile( Resource::getCommonUrl('/libs/jquery.treeview/lib/jquery.cookie.js') , ['depends'=>'yii\web\YiiAsset']);
        LsYii::getView()->registerJsFile( Resource::getCommonUrl('/libs/jquery.treeview/jquery.treeview.js') , ['depends'=>'yii\web\YiiAsset']);
        LsYii::getView()->registerCssFile( Resource::getCommonUrl('/libs/jquery.treeview/jquery.treeview.css') ,['depends'=>'yii\bootstrap\BootstrapAsset']);
        LsYii::getView()->registerJs(<<<EOD
          $("#{$this->treeOptions['id']}").treeview({
                persist: "{$this->presist}",
                collapsed: {$this->collapsed},
                unique: {$this->unique},
                animated: "{$this->animated}",
            });      
EOD
       , \yii\web\View::POS_END);
    }
}
