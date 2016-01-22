<?php

namespace source\helpers;

use source\LsYii;
class StringHelper extends \yii\helpers\StringHelper
{
    /*
     * 中文截取，支持gb2312,gbk,utf-8,big5
     * @param string $str 要截取的字串
     * @param int $start 截取起始位置
     * @param int $length 截取长度
     * @param string $charset utf-8¦gb2312¦gbk¦big5 编码
     * @param $suffix 尾缀
     */
    public static function subString($str, $length = -1, $start = 0, $suffix = null,$charset = "")
    {
        if ($length < 1)
        {
            return $str;
        }
        if ($str == null || empty($str))
        {
            return '';
        }
        
        if (empty($charset))
        {
            $charset = 'utf-8';
        }
        
        if (function_exists('mb_substr'))
        {
            if (mb_strlen($str, $charset) <= $length)
                return $str;
            $slice = mb_substr($str, $start, $length, $charset);
        }
        else
        {
            $re['utf-8'] = "/[\x01-\x7f]¦[\xc2-\xdf][\x80-\xbf]¦[\xe0-\xef][\x80-\xbf]{2}¦[\xf0-\xff][\x80-\xbf]{3}/";
            $re['gb2312'] = "/[\x01-\x7f]¦[\xb0-\xf7][\xa0-\xfe]/";
            $re['gbk'] = "/[\x01-\x7f]¦[\x81-\xfe][\x40-\xfe]/";
            $re['big5'] = "/[\x01-\x7f]¦[\x81-\xfe]([\x40-\x7e]¦\xa1-\xfe])/";
            preg_match_all($re[$charset], $str, $match);
            if (count($match[0]) <= $length)
                return $str;
            $slice = join("", array_slice($match[0], $start, $length));
        }
        if ($suffix != null && ! empty($suffix))
        {
            return $slice . $suffix;
        }
        
        return $slice;
    }
}
