<?php
/**
 * 重新设置Yii基础类的加载路径
 * @author Weizhong Liu <liuweizhong4655@gmail.com>
 * @since 1.0
 * @date 1/8/2016
 */
Yii::$classMap['\yii\helpers\ArrayHelper'] = '@source/helpers/ArrayHelper.php';
Yii::$classMap['\yii\helpers\Html'] = '@source/helpers/Html.php';
Yii::$classMap['\yii\helpers\HtmlPurifier'] = '@source/helpers/HtmlPurifier.php';
Yii::$classMap['\yii\helpers\FileHelper'] = '@source/helpers/FileHelper.php';
Yii::$classMap['\yii\helpers\VarDumper'] = '@source/helpers/VarDumper.php';
Yii::$classMap['\yii\helpers\Url'] = '@source/helpers/Url.php';
Yii::$classMap['\yii\helpers\StringHelper'] = '@source\helpers\StringHelper';
