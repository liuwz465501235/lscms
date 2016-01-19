<?php
/**
 * 跟消息提示有关的类
 * @author Weizhong Liu<liuweizhong4655@gmail.com>
 * @since 1.0
 * @date 1/17/2016
 * <div class="alert alert-success alert-dismissible fade in" role="alert">
    <?php echo $successFlash;?>
</div>
 */
namespace source\libs;

use source\LsYii;
use source\libs\Common;
use source\helpers\Html;
use source\core\back\BackView;

class Message
{
    /**
     * 页面输入成功消息
     * @return string
     */
    public static function getSuccessMessage()
    {
        $flash = LsYii::getFlash('success');
        if(!empty($flash))
        {
            $message = Html::beginTag('div' , ['class'=>'alert alert-success alert-dismissible fade in' , 'role'=>'alert']);
            $message .= $flash;
            $message .= Html::endTag('div');
            LsYii::getView()->registerJs("$(function(){
                setTimeout(function(){
                    $('div.alert-success').remove();
                } , 3000);
            })" , BackView::POS_END);
        }
        else
        {
            $message = '';
        }
        return $message;
    }
    
    /**
     * 页面输入错误消息
     * @return string
     */
    public static function getErrorMessage()
    {
        $flash = LsYii::getFlash('error');
        if(!empty($flash))
        {
            $message = Html::beginTag('div' , ['class'=>'alert alert-warning alert-dismissible fade in' , 'role'=>'alert']);
            $message .= $flash;
            $message .= Html::endTag('div');
            LsYii::getView()->registerJs("$(function(){
                setTimeout(function(){
                    $('div.alert-warning').remove();
                } , 3000);
            })" , BackView::POS_END);
        }
        else
        {
            $message = '';
        }
        return $message;
    }
}