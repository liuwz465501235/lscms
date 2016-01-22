<?php

namespace backend\modules\menu\controllers;

use Yii;
use source\LsYii;
use common\models\Menu;
use common\models\search\MenuSearch;
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
                    'delete' => ['post'],
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

        return $this->render('index', [
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
            LsYii::setErrorMessage( LsYii::gT('该菜单还有子项，不能被删除') );
            return $this->redirect(['index']);
        }
        $rgt = $model->rgt;
        if($model->delete())
        {
            Menu::updateAllCounters(['rgt'=>-2], "`lft`<{$rgt} AND `rgt`>={$rgt}");
            Menu::updateAllCounters(['rgt'=>-2 , 'lft'=>-2], "`lft`>{$rgt}");
            LsYii::setSuccessMessage( LsYii::gT('删除成功') );
        }
        else
        {
            LsYii::setErrorMessage( LsYii::gT('删除失败') );
        }
        return $this->redirect(['index']);
        
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
