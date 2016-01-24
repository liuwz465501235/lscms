<?php

namespace source\modules\user;

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\StringHelper;
use yii\helpers\ArrayHelper;
use source\LsYii;
use source\libs\Common;
use source\libs\Constants;

class UserInfo extends \source\core\modularity\ModuleInfo
{

    public function init()
    {
        parent::init();
        
        $this->id='user';
        $this->name = '用户模块';
        $this->version = '1.0';
        $this->description = '用户管理，如前台注册会员、后台管理员等';
        
        $this->is_system = 1;
    }
}
