<?php

namespace source\modules\modularity\admin;

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\StringHelper;
use yii\helpers\ArrayHelper;
use source\LsYii;
use source\libs\Common;
use source\libs\Constants;


class AdminModule extends \source\core\modularity\BackModule
{

    public $controllerNamespace = 'source\modules\modularity\admin\controllers';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
    
    //public function getMenus()
    //{
    //    return [
    //        ['首页',['/modularity']],
    //        ['设置',['/modularity/setting']],
    //    ];
    //}
}
