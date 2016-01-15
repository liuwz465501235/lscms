<?php

use yii\db\Schema;
use yii\db\Migration;

class m130524_201442_init extends Migration
{
    const TAB_NAME = '{{%user}}';
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        $this->createTable(self::TAB_NAME, [
            'id' => $this->primaryKey(),    //主键id
            'username' => $this->string(30)->notNull()->unique(),   //用户名
            'auth_key' => $this->string(32)->notNull()->defaultValue(''),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'role'=>$this->integer(1)->notNull()->defaultValue(3),  //用户角色 1-后台管理员 2-前台会员
            'name' => $this->string(100)->notNull()->defaultValue(''),  //真实姓名
            'sex' => $this->integer(1)->notNull()->defaultValue(3), //性别 1-男  2-女 3-保密
            'email' => $this->string(100)->notNull()->unique()->defaultValue(''),   //邮箱
            'mobilephone' => $this->string(20)->notNull()->unique()->defaultValue(''),   //手机号码
            'id_number' => $this->string(20)->notNull()->unique()->defaultValue(''),   //身份证号
            'pic' => $this->string()->notNull()->defaultValue(''),   //头像
            'create_id' => $this->integer()->notNull()->defaultValue(0),   //头像
            'created_at' => $this->integer()->notNull()->defaultValue(0),    //创建时间
            'updated_at' => $this->integer()->notNull()->defaultValue(0),    //更新时间
            'lastloginip' => $this->string()->notNull()->defaultValue(''), //最后登录的ip
            'lastlogintime' => $this->integer()->notNull()->defaultValue(0), //最后登录的时间
            'status' => $this->smallInteger()->notNull()->defaultValue(0),  //是否锁定 1-锁定  0-未锁定
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
