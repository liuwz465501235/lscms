<?php

namespace backend\controllers;

use source\LsYii;

class TestController extends \source\core\back\BackController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
