<?php

namespace source\modules\menu\admin\controllers;

use Yii;
use source\LsYii;
use source\modules\menu\models\Menu;
use source\modules\menu\models\search\MenuSearch;
use source\core\back\BackController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use source\libs\Message;

/**
 * MenuController implements the CRUD actions for Menu model.
 */
class SiteController extends BackController
{
    public $topMenu = 27;
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post' , 'get'],
                ],
            ],
        ];
    }

    /**
     * Lists all Menu models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->setMenus(29, "菜单管理");
        $searchModel = new MenuSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $id = LsYii::getGetValue('id' , 1);
        $model = $this->findModel($id);
        $message = LsYii::getGetValue('message' , null);
        $type = LsYii::getGetValue('type' , 1);
        if($message)
        {
            if($type ==1)
            {
                LsYii::setSuccessMessage($message);
            }
            else if($type==2)
            {
                LsYii::setErrorMessage($message);
            }
        }
        return $this->render('index', [
            'model'=>$model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Menu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->setMenus(29, "添加新菜单");
        $model = new Menu();
        $id = LsYii::getGetValue('id' , null);
        if($id)
            $model->pid = $id;
        if ($model->load(LsYii::getRequest()->post())) 
        {
            $pid = $model->pid;
            if($pid) 
            {
                $c = Menu::findOne(['`id`'=>$pid]);
                $rgt = $c->rgt;
                $model->root = $c->root;
                $model->pid = $c->id;
                $model->level = $c->level+1;
                $model->lft = $rgt;
                $model->rgt = $rgt+1;
            } 
            else 
            {
                $maxRgt = Menu::getMaxRgt();
                $model->lft = $maxRgt+1;
                $model->rgt = $maxRgt+2;
                $model->pid = 0;
                $model->level = 1;
            }
            if($model->save())
            {
                if(!$pid)
                {
                    $menu = Menu::findOne(['`id`'=>$model->id]);
                    $menu->root = $model->id;
                    $menu->save();
                }
                else
                {
                    Menu::updateAllCounters(['rgt'=>2], "`lft`<{$rgt} AND `rgt`>={$rgt}");
                    Menu::updateAllCounters(['rgt'=>2 , 'lft'=>2], "`lft`>{$rgt}");
                }
            }
            return $this->redirect(['index']);
        } else {
            $model->if_show = \source\libs\Constants::Menu_Status_Show;
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Menu model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $this->setMenus(29, "修改菜单项");
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Menu model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->setMenus(29, "删除菜单");
        $model = $this->findModel($id);
        //判断是否有子项
        if(Menu::findAll(['pid'=>$id])) 
        {
            return $this->redirect(['index' , 'message'=>LsYii::gT('该菜单还有子项，不能被删除') , 'type'=>2]);
        }
        if($model->if_delete==\source\libs\Constants::If_Delete_Prohibit)
        {
            return $this->redirect(['index' , 'message'=>LsYii::gT('该分类不允许被删除') , 'type'=>2]);
        }
        $rgt = $model->rgt;
        if($model->delete())
        {
            Menu::updateAllCounters(['rgt'=>-2], "`lft`<{$rgt} AND `rgt`>={$rgt}");
            Menu::updateAllCounters(['rgt'=>-2 , 'lft'=>-2], "`lft`>{$rgt}");
            $message = LsYii::gT('删除成功');
            $type = 1;
        }
        else
        {
            $message = LsYii::gT('删除失败');
            $type = 2;
        }
        return $this->redirect(['index' , 'message'=>$message , 'type'=>$type]);
        
    }

    /**
     * Finds the Menu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Menu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Menu::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
