<?php

namespace source\modules\modularity\admin\controllers;

use Yii;
use source\modules\modularity\models\Modularity;
use source\modules\modularity\models\search\ModularitySearch;
use source\core\back\BackController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use source\helpers\VarDumper;
use source\core\data\ArrayDataProvider;
use source\LsYii;

/**
 * DefaultController implements the CRUD actions for Modularity model.
 */
class DefaultController extends BackController
{
    public $topMenu = 4;
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Modularity models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->setMenus(12, "Modularity Setting");
        $modules = $this->modularityService->getAllModules();
//        VarDumper::dump($modules , 10 , true , false);
        $dataProvider = new ArrayDataProvider([
            'allModels'=>$modules,
            'pagination' => [        
                'pageSize' => 10
            ]
        ]);
        $message = LsYii::getGetValue('message', null);
        $msgType = LsYii::getGetValue('msgType', 1);
        if($message)
        {
            if($msgType == 1)
            {
                LsYii::setSuccessMessage($message);
            }
            else if($msgType == 2)
            {
                LsYii::setErrorMessage($message);
            }
        }
        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * 安装模块
     * 'canInstall' => false
     * 'canUninstall' => true
     * 'hasAdmin' => true
     * 'hasHome' => true
     * 'canActiveAdmin' => true
     * 'canActiveHome' => true
     * @param type $id
     */
    public function actionInstall($id)
    {
        $lastBreadcrumb = "Install Modularity";
        $this->setMenus(12, $lastBreadcrumb);
        $model = new Modularity();
        $model->id = $id;
        $model->is_system = 0;
        $model->is_content = 0;
        $model->enable_admin = 0;
        $model->enable_home = 0;
        if($model->save())
        {
            $modules = $this->modularityService->getAllModules();
            if (isset($modules[$id]) && $modules[$id]['instance'] !== null)
            {
                $modules[$id]['instance']->install();
            }
            $this->redirect([
                'index',
                'message'=>\Yii::t('yii', '{attribute} Success', ['attribute'=>LsYii::gT($lastBreadcrumb)])
            ]);
        }
        else
        {
            $this->redirect([
                'index', 
                'message'=>\Yii::t('yii', '{attribute} Error', ['attribute'=>LsYii::gT($lastBreadcrumb)]),
                'msgType'=>2
            ]);
        }
    }
    
    /**
     * 启用后台
     * 'canInstall' => false
     * 'canUninstall' => false
     * 'hasAdmin' => true
     * 'hasHome' => true
     * 'canActiveAdmin' => false
     * 'canActiveHome' => true
     * 启用前台
     * 'canInstall' => false
     * 'canUninstall' => false
     * 'hasAdmin' => true
     * 'hasHome' => true
     * 'canActiveAdmin' => false
     * 'canActiveHome' => false
     * @param type $id
     * @param type $isAdmin
     * @return type
     */
    public function actionActive($id , $isAdmin=null)
    {
        $lastBreadcrumb = $isAdmin==1 ? "Active Admin" : "Active Home";
        $field = $isAdmin==1 ? "enable_admin" : "enable_home";
        $this->setMenus(12, $lastBreadcrumb);
        Modularity::updateAll([$field => 1], ['id' => $id ]);
        
        $modules = $this->modularityService->getAllModules();
        if (isset($modules[$id]) && $modules[$id]['instance'] !== null)
        {
            if ($isAdmin === null)
            {
                $modules[$id]['instance']->activeHome();
            }
            else
            {
                $modules[$id]['instance']->activeAdmin();
            }
        }
        return $this->redirect([
            'index',
            'message'=>\Yii::t('yii', '{attribute} Success', ['attribute'=>LsYii::gT($lastBreadcrumb)])
        ]);
    }
    
    /**
     * 关闭后台
     * 'canInstall' => false
     * 'canUninstall' => false
     * 'hasAdmin' => true
     * 'hasHome' => true
     * 'canActiveAdmin' => true
     * 'canActiveHome' => false
     * 关闭前台
     * 'canInstall' => false
     * 'canUninstall' => true
     * 'hasAdmin' => true
     * 'hasHome' => true
     * 'canActiveAdmin' => true
     * 'canActiveHome' => true
     * @param type $id
     * @param type $isAdmin
     * @return type
     */
    public function actionDeactive($id, $isAdmin = null)
    {
        $lastBreadcrumb = $isAdmin==1 ? "Deactive Admin" : "Deactive Home";
        $field = $isAdmin === null ? 'enable_home' : 'enable_admin';
        $this->setMenus(12, $lastBreadcrumb);
        Modularity::updateAll([$field => 0], ['id' => $id ]);
        
        $modules = $this->modularityService->getAllModules();
        if (isset($modules[$id]) && $modules[$id]['instance'] !== null)
        {
            if ($isAdmin === null)
            {
                $modules[$id]['instance']->deactiveHome();
            }
            else
            {
                $modules[$id]['instance']->deactiveAdmin();
            }
        }
        return $this->redirect([
            'index',
            'message'=>\Yii::t('yii', '{attribute} Success', ['attribute'=>LsYii::gT($lastBreadcrumb)])
        ]);
    }
    
    /**
     * 卸载
     * 'canInstall' => true
     * 'canUninstall' => true
     * 'hasAdmin' => true
     * 'hasHome' => true
     * 'canActiveAdmin' => false
     * 'canActiveHome' => false
     * @param type $id
     * @return type
     */
    public function actionUninstall($id)
    {
        $lastBreadcrumb = "Uninstall Modularity";
        $this->setMenus(12, $lastBreadcrumb);
        Modularity::deleteAll(['id' => $id ]);
        
        $modules = $this->modularityService->getAllModules();
        if (isset($modules[$id]) && $modules[$id]['instance'] !== null)
        {
            $modules[$id]['instance']->uninstall();
        }
        
        return $this->redirect([
            'index',
            'message'=>\Yii::t('yii', '{attribute} Success', ['attribute'=>LsYii::gT($lastBreadcrumb)])
        ]);
    }
}
