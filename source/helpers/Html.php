<?php
namespace source\helpers;

use source\LsYii;

class Html extends \yii\helpers\Html
{
    /**
     * 生成保存与关闭的按钮
     * @param type $submitText
     * @param type $closeLink
     */
    public static function SubmitButtons($submitText , $closeLink = null) {
        echo Html::beginTag('div', ['class'=>'form-group center']);
        echo Html::submitButton(LsYii::gT($submitText), ['class' => 'btn btn-primary' , 'name'=>'save']);
        if($closeLink !== null)
        {
            echo Html::a(LsYii::gT("Return"), $closeLink, ['name'=>'close','class'=>'btn btn-default' , 'style'=>'margin-left:10px;']);
        }
        echo Html::endTag('div');
    }
}
