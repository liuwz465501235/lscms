<?php 
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use source\LsYii;
use source\libs\Common;
use source\libs\Resource;

/* @var $this source\core\front\FrontView */

$this->title='填写数据库信息';
?>
<style>
    .cnote {
        color: red;
    }
</style>

<div class="header">
    <div class="step_area"><h2>第二步：配置数据库</h2></div>
</div>
<div class="mainbody">
    <div class="step_sgin"><span class="step step_2"></span></div>
    <h4 class="install_title">填写数据库信息</h4>
    
    <?php $form = ActiveForm::begin([
              'id'=>'dbForm',
        'action'=>Url::to(['progress']),
        
    ]);?>
    <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="tb">
        <tr>
            <th width="25%" height="30" align="right">数据库服务器：</th>
            <td>
                <input value="localhost" type="text" name="dbHost" id="dbHost" class="class_input required" />
                <span class="dbHost">数据库服务器地址, 一般为本地:localhost</span></td>
        </tr>
        <tr>
            <th height="30" align="right">数据库名称：</th>
            <td>
                <input value="lscms" type="text" name="dbName" id="dbName" class="class_input required" />
                <span class="dbName">请先创建数据库</span>
            </td>
        </tr>
        <tr>
            <th height="30" align="right">数据库用户：</th>
            <td>
                <input value="root" type="text" name="dbUsername" id="dbUsername" class="class_input required" />
                <span class="dbUsername"></span>
            </td>
        </tr>
        <tr>
            <th height="30" align="right">数据库密码：</th>
            <td>
                <input name="dbPassword" type="password" class="class_input" id="dbPassword" value="" />
                <span class="dbPassword"></span>
            </td>
        </tr>
        <tr>
            <th height="30" align="right">数据表前缀：</th>
            <td>
                <input value="ls_" type="text" name="tbPre" id="tbPre" class="class_input" />
                <span class="tbPre">同一数据库运行多个程序时，请修改前缀</span>
            </td>
        </tr>
    </table>

    <h4 class="install_title">填写管理员信息</h4>
    <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
            <th width="25%" height="30" align="right">管理员账号：</th>
            <td>
                <input value="" type="text" name="username" id="username" class="class_input required" />
                <span class="username"></span>
            </td>
        </tr>
        <tr>
            <th height="30" align="right">管理员密码：</th>
            <td>
                <input value="" type="password" name="password" id="password" class="class_input required" />
                <span class="password"></span>
            </td>
        </tr>
        <tr>
            <th height="30" align="right">重复密码：</th>
            <td>
                <input value="" type="password" name="passwordRe" id="passwordRe" class="class_input required" />
                <span class="passwordRe"></span>
            </td>
        </tr>
        <tr>
            <th height="30" align="right">管理员邮箱：</th>
            <td>
                <input value="" type="email" name="email" id="email" class="class_input email required" />
                <span class="email"></span>
            </td>
        </tr>
<!--        <tr>
            <th height="30" align="right">安装测试数据：</th>
            <td>
                <input value="Y" type="checkbox" name="testData" style="margin-left: 5px;" id="testData" />
                是
            </td>
        </tr>
        <tr>
            <th height="30" align="right">&nbsp;</th>
            <td>
                <p class="red">全新安装会覆盖旧数据 </p>
            </td>
        </tr>-->
    </table>
    <div class="inst_btn_area">
        <button type="button" onclick="history.go(-1);return false;" class="button">返　回</button>
        &nbsp;
        <button type="submit" class="button">下一步</button>
    </div>
    <?php ActiveForm::end();?>
</div>
<?php
Resource::jsFile( Resource::getCommonUrl('/js/jquery.min.js') );
Resource::jsFile( Resource::getInstallUrl("/js/jquery.db.validate.js") );
?>