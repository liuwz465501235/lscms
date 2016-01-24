<?php
/**
 * 表单生成组件
 * @author Weizhong Liu <liuweizhong4655@gmail.com>
 * @since 1.0
 * @date 1/16/2016
 */
namespace source\core\widgets;

use source\LsYii;
use source\libs\Common;


class ActiveForm extends \yii\widgets\ActiveForm
{
    /**
     * 重写输入框
     * @param type $model
     * @param type $attribute
     * @param type $options
     * @return type
     */
    public function field($model, $attribute, $options = array())
    {
        if(empty($options))
        {
            $options = [
                'template'=>'{label}<div class="col-sm-5">{input}</div><div class="col-sm-5">{error}</div>',
                'labelOptions'=>['class'=>'col-sm-2 control-label']
            ];
        }
        return parent::field($model, $attribute, $options);
    }
}
