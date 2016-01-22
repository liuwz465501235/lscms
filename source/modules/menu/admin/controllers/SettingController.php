<?php

namespace source\modules\menu\admin\controllers;

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\StringHelper;
use yii\helpers\ArrayHelper;
use source\LsYii;
use source\libs\Common;
use source\libs\Constants;
use source\modules\menu\models\Setting;

class SettingController extends \backend\controllers\BaseSettingController
{
    public function actionIndex()
    {
        $model = new Setting();
        
        return $this->doConfig($model);
    }
}
