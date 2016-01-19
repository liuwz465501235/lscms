<?php

namespace install\controllers;

use source\LsYii;
use install\models\LoginForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use source\core\install\InstallController;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use source\helpers\FileHelper;
use source\libs\Utility;
use source\helpers\Html;
use \yii\db\Connection;
use source\helpers\VarDumper;
use source\helpers\Url;
use source\libs\Constants;
use source\libs\Common;

/**
 * Site controller
 */
class SiteController extends InstallController
{
    //安装前的检测
    public function beforeAction($action) {
        //安装的路径文件
        if($action->id == 'stop')
        {
            return parent::beforeAction($action);
        }
        if( Common::checkIsInstalled() === true && $action->id !== 'complete')
        {
            return $this->redirect( ['site/stop'] );
        }
        return parent::beforeAction($action);
    }


    //安装欢迎页
    public function actionIndex()
    {
        return $this->render('index');
    }

    //环境检测
    public function actionEnv()
    {
        $data = $this->getEnvData();
        return $this->render('env', $data);
    }

    //数据库配置
    public function actionDb()
    {
        return $this->render('db', []);
    }

    //安装数据库
    public function actionProgress()
    {
        return $this->render('progress', []);
    }

    //完成安装
    public function actionComplete()
    {
        return $this->render('complete', []);
    }
    
    //停止安装
    public function actionStop()
    {
        return $this->render('stop' , []);
    }

    public function afterResponse()
    {
        if (LsYii::getApp()->requestedAction->id == 'progress')
        {
            $this->installing();    //执行安装
        }
    }

    private function installing()
    {
        LsYii::getApp()->controller = $this;

        if ($this->checkParam() === false)
        {
            return;
        }

        if ($this->checkDb() === FALSE)
        {
            return;
        }

        if (($dbConfig = $this->writeConfig()) === false)
        {
            return;
        }

        if (($db = $this->setDb($dbConfig)) === false)
        {
            return false;
        }

        $transcation = $db->beginTransaction();

        try
        {
            self::_appendLog( LsYii::gT("开始创建数据库表。。。"));

            if ($this->executeSql($db, 'install') !== true)
            {
                $transcation->rollBack();
                self::_appendLog( LsYii::gT("数据库创建失败"), true);
                return;
            }
            self::_appendLog( LsYii::gT("数据库创建成功") );

            self::_appendLog( LsYii::gT('生成管理员。。。') );
            $this->insertAdmin($db);
            self::_appendLog( LsYii::gT('管理员生成成功') );

            $transcation->commit();

            $file = Constants::getCommonUrl(Constants::InstallFile_Url);

            @touch($file);

            self::_appendLog( LsYii::gT('安装完成') );
            echo '<script>window.location="' . Url::to(['complete']) . '"</script>';
        }
        catch (\Exception $ex)
        {
            $transcation->rollBack();

            $message = self::getDbError($ex->getMessage(), [
                        'dbHost' => $dbHost,
                        'dbName' => $dbName
            ]);
            self::_appendLog( LsYii::gT('安装失败') );
            self::_appendLog($e->getMessage(), true);
        }
    }

    /**
     * 检查传入的参数
     * @return boolean
     */
    private function checkParam()
    {
        self::_appendLog(LsYii::gT("开始检查提交参数。。。"));
        $dbHost = LsYii::getPostValue('dbHost');
        $dbName = LsYii::getPostValue('dbName');
        $dbUsername = LsYii::getPostValue('dbUsername');
        $dbPassword = LsYii::getPostValue('dbPassword');
        $tbPre = LsYii::getPostValue('tbPre');
        $username = LsYii::getPostValue('username');
        $password = LsYii::getPostValue('password');
        $passwordRe = LsYii::getPostValue('passwordRe');
        $email = LsYii::getPostValue('email');
        if (!$dbHost || !$dbName || !$dbUsername || !$dbPassword)
        {
            self::_appendLog( LsYii::gT("数据库信息必须完整"), true);
            return false;
        }
        if (!$username || !$password || !$passwordRe || !$email)
        {
            self::_appendLog( LsYii::gT("后台管理员信息必须完整"), true);
            return false;
        }
        if ($password != $passwordRe)
        {
            self::_appendLog( LsYii::gT("两次密码必须一致"), true);
            return false;
        }
        if (!preg_match("/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/", $email))
        {
            self::_appendLog( LsYii::gT("邮箱格式不正确"), true);
            return false;
        }
        self::_appendLog( LsYii::gT("参数验证成功"));
        return true;
    }

    /**
     * 检测数据库
     */
    private function checkDb()
    {
        $dbHost = LsYii::getPostValue('dbHost');
        $dbName = LsYii::getPostValue('dbName');
        $dbUsername = LsYii::getPostValue('dbUsername');
        $dbPassword = LsYii::getPostValue('dbPassword');
        self::_appendLog( LsYii::gT("开始检查数据库信息。。。"));

        $dbConfig = [
            "dsn" => "mysql:host={$dbHost};dbname={$dbName}",
            "username" => $dbUsername,
            "password" => $dbPassword
        ];
        $db = new Connection($dbConfig);
        $result = false;
        try
        {
            $res = $db->open();
            if (!$db->isActive)
            {
                $message = LsYii::gT("数据库连接不上，请返回检测");
                $result = false;
            }
            else
            {
                $message = LsYii::gT("数据库信息正确");
                $result = true;
            }
        }
        catch (\Exception $ex)
        {
            $message = self::getDbError($ex->getMessage(), [
                'dbHost' => $dbHost,
                'dbName' => $dbName
            ]);
            $result = false;
        }
        self::_appendLog($message, !$result);
        return $result;
    }

    /**
     * 将数据库信息写入配置文件中
     */
    private function writeConfig()
    {
        $dbHost = LsYii::getPostValue('dbHost');
        $dbName = LsYii::getPostValue('dbName');
        $dbUsername = LsYii::getPostValue('dbUsername');
        $dbPassword = LsYii::getPostValue('dbPassword');
        $tbPre = LsYii::getPostValue('tbPre');
        self::_appendLog( LsYii::gT("开始写入数据库的配置信息。。。") );

        $dbConfig = [
            "class" => "yii\\db\\Connection",
            "dsn" => "mysql:host={$dbHost};dbname={$dbName}",
            "username" => $dbUsername,
            "password" => $dbPassword,
            "charset" => 'utf8',
            "tablePrefix" => $tbPre,
            "enableSchemaCache" => true,
            "schemaCache" => "schemaCache",
        ];

        try
        {
            $file = LsYii::getAlias("@common/config/db.php");
            FileHelper::writeArray($file, $dbConfig);

            self::_appendLog(LsYii::gT("写入数据库的配置信息成功"));
            unset($dbConfig['class']);
            return $dbConfig;
        }
        catch (\Exception $ex)
        {
            $message = LsYii::gT("保存配置文件出错<br/>" . $ex->getMessage());
            self::_appendLog($message, true);
            return false;
        }
    }

    /**
     * 设置数据库信息
     * @param type $dbConfig
     */
    private static function setDb($dbConfig)
    {
        self::_appendLog(LsYii::gT("开始设置数据库信息。。。"));
        $dbHost = LsYii::getPostValue('dbHost');
        $dbName = LsYii::getPostValue('dbName');

        try
        {
            $db = new Connection($dbConfig);

            LsYii::getApp()->set('db', $db);

            $db->createCommand("USE {$dbName}")->execute();
            $db->createCommand("SET NAMES utf8,character_set_client=binary,sql_mode=''")->execute();

            self::_appendLog(LsYii::gT("数据库信息设置成功"));

            return $db;
        }
        catch (\Exception $ex)
        {
            $message = self::getDbError($ex->getMessage(), [
                        'dbHost' => $dbHost,
                        'dbName' => $dbName
            ]);
            self::_appendLog($message, true);
            return false;
        }
    }

    /**
     * 创建数据库
     * @param type $db
     * @param type $file
     */
    private function executeSql($db, $file)
    {
        $file = LsYii::getAlias("@data/sql/{$file}.sql");

        if (!FileHelper::exist($file))
        {
            self::_appendLog(LsYii::gT("安装的sql文件不存在"), true);
            return false;
        }
        $tbPre = $db->tablePrefix;
        //获取sql文件
        $content = file_get_contents($file);

        $sqls = self::_splitsql($content);
        if (is_array($sqls))
        {
            foreach ($sqls as $sql)
            {
                if (trim($sql) != '')
                {
                    $db->createCommand( str_replace('#@__', $tbPre, $sql) )->execute();
                    $msgLog = self::_createMsgLog(str_replace('#@__', $tbPre, $sql));
                    self::_appendLog( $msgLog );
                }
            }
        }
        else
        {
            $db->createCommand(str_replace('#@__', $tbPre, $sqls))->execute();
            $msgLog = self::_createMsgLog(str_replace('#@__', $tbPre, $sqls));
            self::_appendLog( $msgLog );
        }
        return true;
    }

    /**
     * 生成管理员
     * @param type $db
     */
    private function insertAdmin($db)
    {
        $username = LsYii::getPostValue('username');
        $password = LsYii::getPostValue('password');
        $email = LsYii::getPostValue('email');

        $tbPre = $db->tablePrefix;
        $user = new \common\models\User();
        $user->scenario = 'create';
        $user->username = $username;
        $user->password = $password;
        $user->email = $email;
        $user->role = 'administrator';
        $user->status = Constants::Status_Enable;
        $user->save();
    }
    
    private static function _createMsgLog($sql) {
        $sql = trim($sql);
        if(strncmp($sql , 'DROP' , 4) === 0)
        {   //删除表
            $msgLog = $sql;
        } 
        else if(strncmp($sql , 'CREATE' , 6) === 0)
        {   //新建表
            $pos = strpos($sql, '(');
            $msgLog = substr($sql, 0 , $pos);
        }
        else if(strncmp($sql, 'INSERT', 6) === 0)
        {   //插入表
            $pos = strpos($sql, '(');
            $msgLog = substr($sql, 0 , $pos);
        }
        else
        {
            $msgLog = $sql;
        }
        return $msgLog;
    }

    /**
     * 重组sql文件的内容
     * @param type $content
     */
    private static function _splitsql($sql)
    {
        $sql = preg_replace("/TYPE=(InnoDB|MyISAM|MEMORY)( DEFAULT CHARSET=[^; ]+)?/", "ENGINE=\\1 DEFAULT CHARSET=UTF8", $sql);
        $sql = str_replace("\r", "\n", $sql);
        $ret = array();
        $num = 0;
        $queriesarray = explode(";\n", trim($sql));
        unset($sql);
        foreach ($queriesarray as $query)
        {
            $ret[$num] = '';
            $queries = explode("\n", trim($query));
            $queries = array_filter($queries);
            foreach ($queries as $query)
            {
                $str1 = substr($query, 0, 1);
                if ($str1 != '#' && $str1 != '-')
                    $ret[$num] .= $query;
            }
            $num ++;
        }
        return ($ret);
    }

    /**
     * 分析数据库的错误信息
     * @param type $message
     * @param type $params
     */
    private static function getDbError($message, $params)
    {
        LsYii::info($message, __METHOD__);

        if (preg_match('/SQLSTATE\[HY000\] \[2002\]/', $message))
        {
            $message = LsYii::gT('连接失败，请检查数据库配置');
        }
        elseif (preg_match('/Unknown database|1049/', $message))
        {
            $message = LsYii::gT('未找到数据库: ' . $params['dbName'] . ' 请先创建该库');
        }
        elseif (preg_match('/failed to open the DB/', $message))
        {
            $message = LsYii::gT('连接失败，请检查数据库配置: ' . $params['dbHost']);
        }
        elseif (preg_match('/1044/', $message))
        {
            $message = LsYii::gT('当前用户没有访问数据库的权限');
        }
        else
        {
            //$ret = false;
        }
        return $message;
    }

    /**
     * 输出日志消息
     * @param type $message 要输出的日志消息
     * @param type $callback 是否要返回检测用户输入
     */
    private static function _appendLog($message, $callback = false)
    {
        if ($callback)
        {
            $message .= '<br/> <a href="' . Url::to(['site/db']) . '" class="red">' . LsYii::gT('返回检测') . '</a>';
        }
        $message = json_encode($message);
        echo '<script type="text/javascript"> var message=' . $message . ';$("#progress").append(message + "<br/>");</script>';
        ob_flush();
        flush();
    }

    /**
     * 服务器环境检测
     * @return type
     */
    private function getEnvData()
    {
        $isWritable = [
            [
                '系统临时文件(data/runtime)',
                true,
                FileHelper::canWrite(LsYii::getAlias('@data/runtime')),
                '系统核心',
                '必须可读写'
            ],
            [
                '附件上传目录(data/attachment)',
                false,
                FileHelper::canWrite(LsYii::getAlias('@data/attachment')),
                '附件上传',
                '若无附件上传可不用写权限'
            ],
            [
                '数据备份目录(data/backup)',
                false,
                FileHelper::canWrite(LsYii::getAlias('@data/backup')),
                '数据库备份',
                '若不备份数据库可不用写权限'
            ],
            [
                '配置文件目录(common/config)',
                false,
                FileHelper::canWrite(LsYii::getAlias('@common/config')),
                '安装程序',
                '若手动安装系统写可不用写权限'
            ],
            [
                '公共资源文件(webroot/assets)',
                true,
                FileHelper::canWrite(LsYii::getAlias('@webroot/assets')),
                '系统核心',
                '必须可读写'
            ]
        ];

        $requirements = array(
            [
                'PHP版本',
                true,
                version_compare(PHP_VERSION, "5.4.0", ">="),
                '系统核心',
                'PHP 5.4.0 或更高版本是必须的.'
            ],
            [
                '$_SERVER 服务器变量',
                true,
                'ok' === $message = Utility::checkServerVar(),
                '系统核心',
                $message
            ],
            [

                'Reflection 扩展模块',
                true,
                class_exists('Reflection', false),
                '系统核心',
                ''
            ],
            [
                'PCRE 扩展模块',
                true,
                extension_loaded("pcre"),
                '系统核心',
                ''
            ],
            [
                'SPL 扩展模块',
                true,
                extension_loaded("SPL"),
                '系统核心',
                ''
            ],
            //[
            //    'DOM 扩展模块',
            //    false,
            //    class_exists("DOMDocument", false),
            //    'CHtmlPurifier, CWsdlGenerator',
            //    ''
            //],
            [
                'PDO 扩展模块',
                true,
                extension_loaded('pdo'),
                '所有和使用PDO数据库连接相关的类',
                ''
            ],
            [
                'PDO MySQL 扩展模块',
                true,
                extension_loaded('pdo_mysql'),
                'MySql数据库',
                '使用MySql数据库必须支持'
            ],
            [
                'OpenSSL 扩展模块',
                true,
                extension_loaded('openssl'),
                'Security',
                '加密和解密方法'
            ],
            //[
            //    'SOAP 扩展模块',
            //    false,
            //    extension_loaded("soap"),
            //    'CWebService, CWebServiceAction',
            //    ''
            //],
            [
                'GD 扩展模块',
                false,
                'ok' === $message = Utility::checkCaptchaSupport(),
                'CaptchaAction',
                $message
            ],
                //[
                //    'Ctype 扩展模块',
                //    false,
                //    extension_loaded("ctype"),
                //    'CDateFormatter, CDateFormatter, CTextHighlighter, CHtmlPurifier',
                //    ''
                //]
        );

        $requireResult = 1;
        foreach ($requirements as $i => $requirement)
        {
            if ($requirement[1] && !$requirement[2])
                $requireResult = 0;
            else if ($requireResult > 0 && !$requirement[1] && !$requirement[2])
                $requireResult = - 1;
            if ($requirement[4] === '')
                $requirements[$i][4] = '&nbsp;';
        }

        $writeableResult = 1;
        foreach ($isWritable as $k => $val)
        {
            if ($val[1] && !$val[2])
                $writeableResult = 0;
            else if ($requireResult > 0 && !$val[1] && !$val[2])
                $writeableResult = - 1;
            if ($val[4] === '')
                $isWritable[$i][4] = '&nbsp;';
        }
        $data = [
            'isWritable' => $isWritable,
            'writeableResult' => $writeableResult,
            'requireResult' => $requireResult,
            'requirements' => $requirements
        ];
        return $data;
    }

}
