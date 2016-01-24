<?php

namespace source\modules\category\admin\controllers;

use Yii;
use source\modules\category\models\Category;
use source\modules\category\models\search\CategorySearch;
use source\core\back\BackController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use source\LsYii;

/**
 * DefaultController implements the CRUD actions for Category model.
 */
class DefaultController extends BackController
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
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->setMenus(30, "分类管理");
        $searchModel = new CategorySearch();
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
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->setMenus(30, "添加新分类");
        $model = new Category();
        $id = LsYii::getGetValue('id' , null);
        if($id)
            $model->pid = $id;
        if ($model->load(LsYii::getRequest()->post())) 
        {
            $pid = $model->pid;
            if($pid) 
            {
                $c = Category::findOne(['`id`'=>$pid]);
                $rgt = $c->rgt;
                $model->root = $c->root;
                $model->pid = $c->id;
                $model->level = $c->level+1;
                $model->lft = $rgt;
                $model->rgt = $rgt+1;
            } 
            else 
            {
                $maxRgt = Category::getMaxRgt();
                $model->lft = $maxRgt+1;
                $model->rgt = $maxRgt+2;
                $model->pid = 0;
                $model->level = 1;
            }
            if($model->save())
            {
                if(!$pid)
                {
                    $menu = Category::findOne(['`id`'=>$model->id]);
                    $menu->root = $model->id;
                    $menu->save();
                }
                else
                {
                    Category::updateAllCounters(['rgt'=>2], "`lft`<{$rgt} AND `rgt`>={$rgt}");
                    Category::updateAllCounters(['rgt'=>2 , 'lft'=>2], "`lft`>{$rgt}");
                }
            }
            return $this->redirect(['index']);
        } else {
            $model->if_show = \source\libs\Constants::Category_Status_Show;
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $this->setMenus(30, "修改分类");
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
     * Deletes an existing Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->setMenus(30, "删除分类");
        $model = $this->findModel($id);
        //判断是否有子项
        if(Category::findAll(['pid'=>$id])) 
        {
            return $this->redirect(['index' , 'message'=>LsYii::gT('该分类还有子项，不能被删除') , 'type'=>2]);
        }
        if($model->if_delete==\source\libs\Constants::If_Delete_Prohibit)
        {
            return $this->redirect(['index' , 'message'=>LsYii::gT('该分类不允许被删除') , 'type'=>2]);
        }
        $rgt = $model->rgt;
        if($model->delete())
        {
            Category::updateAllCounters(['rgt'=>-2], "`lft`<{$rgt} AND `rgt`>={$rgt}");
            Category::updateAllCounters(['rgt'=>-2 , 'lft'=>-2], "`lft`>{$rgt}");
            $message = LsYii::gT('删除成功');
            $type = 1;
        }
        else
        {
            $message = LsYii::gT('删除失败');
            $type = 2;
        }
        return $this->redirect([
            'index',
            'message'=>$message,
            'type'=>$type
        ]);
        
    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
