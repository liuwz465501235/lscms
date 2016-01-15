<?php
namespace source\helpers;

use source\LsYii;
class VarDumper extends \yii\helpers\VarDumper
{
    /**
     * 打印输出
     * @param type $var
     * @param type $depth
     * @param type $highlight
     * @param type $isDie
     */
    public static function dump($var, $depth = 10, $highlight = true , $isDie = true)
    {
        if($highlight) {
            parent::dump($var, $depth, $highlight);
        } else {
            echo '<pre>';
            parent::dump($var, $depth, $highlight);
            echo '</pre>';
        }
        if($isDie === true)
            die();
    }
    
    public static function jsonEncode($var) {
        return json_encode($var);
    }
}
