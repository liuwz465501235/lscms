<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace source\traits;

use yii;
use yii\helpers\VarDumper;
use yii\helpers\Url;
use yii\data\Pagination;
use yii\web\Cookie;
use source\LsYii;

trait CommonTrait 
{
    public function __get($name)
    {
        $dot = strpos($name, "Service");
        if($dot > 0)
        {
            $serviceName = substr($name, 0 , $dot);
            return LsYii::getService($serviceName);
        }
        return parent::__get($name);
    }
}