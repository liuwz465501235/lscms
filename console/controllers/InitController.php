<?php
/**
 * 生成默认的用户名和密码
 */
namespace console\controllers;
class InitController extends \yii\console\Controller {
    public function actionUser() {
        echo 'Start Input User ：';
        $username = $this->prompt("Username: ");    //接收用户名
        $email = $this->prompt("Email: ");  //接收邮箱
        $role = $this->prompt("Role: ");    //接收用户类型
        $password = $this->prompt("Password: ");    //接收密码
        $model = new \common\models\User();
        $model->username = $username;
        $model->email = $email;
        $model->role = $role;
        $model->password = $password;
        if(!$model->save()) {
            foreach($model->getErrors() as $errors) {
                foreach($errors as $e) {
                    echo "$e\r\n";
                }
            }
            return 1;
        }
        return 0;
    }
}