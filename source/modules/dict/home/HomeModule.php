<?php

namespace source\modules\dict\home;

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\StringHelper;
use yii\helpers\ArrayHelper;
use source\LsYii;
use source\libs\Common;
use source\libs\Constants;

class HomeModule extends \source\core\modularity\FrontModule
{
    
    public $controllerNamespace = 'source\modules\dict\home\controllers';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
    
}
