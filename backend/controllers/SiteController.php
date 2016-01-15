<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use source\core\back\BackController;
use backend\models\LoginForm;
use yii\filters\VerbFilter;
use source\LsYii;

/**
 * Site controller
 */
class SiteController extends BackController
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                'width'=>'100',
                'maxLength'=>'4',
                'minLength'=>'4'
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        $this->layout = 'login';
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        $message = [];
        if( $model->load(LsYii::getRequest()->post()) )
        {
            if( $model->login() )
            {
                $this->redirect(\source\helpers\Url::to(['index']));
            }
            else
            {
                foreach ($model->getErrors() as $errors)
                {
                    foreach($errors as $error)
                    {
                        $message[] = $error;
                    }
                }
            }
        }
        return $this->render('login', [
            'model' => $model,
            'message'=> !empty($message) ? $message[0] : ''
        ]);
    }
    
//    public function actionError()
//    {
//        if(\Yii::$app->errorHandler)
//        {
//            
//        }
//    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
