<?php

namespace source\modules\rbac\admin\controllers;

use Yii;
use source\LsYii;
use source\modules\rbac\models\Role;
use source\modules\rbac\models\search\RoleSearch;
use source\core\back\BackController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RoleController implements the CRUD actions for Role model.
 */
class RoleController extends BackController
{
    public $topMenu = 13;
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
     * Lists all Role models.
     * @return mixed
     */
    public function actionIndex($category)
    {
        Role::setMenus($category);
        $searchModel = new RoleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $message = LsYii::getGetValue('message' , '');
        $type = LsYii::getGetValue('type' , 1);
        if($message)
        {
            if($type == 1)
            {
                LsYii::setSuccessMessage($message);
            }
            else if($type == 2)
            {
                LsYii::setErrorMessage($message);
            }
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    /**
     * 系统角色
     * @return type
     */
    public function actionSystem()
    {
        $this->redirect([
            'index',
            'category'=>'system'
        ]);
    }
    
    /**
     * 会员角色
     * @return type
     */
    public function actionMember()
    {
        $this->redirect([
            'index',
            'category'=>'member'
        ]);
    }
    
    /**
     * 会员角色
     * @return type
     */
    public function actionAdmin()
    {
        $this->redirect([
            'index',
            'category'=>'admin'
        ]);
    }

    /**
     * Displays a single Role model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Role model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($category)
    {
        Role::setMenus($category);
        $model = new Role();
        $model->category = $category;
        $model->is_system=0;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'category' => $category]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Role model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $category  = LsYii::getGetValue('category');
        Role::setMenus($category);
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'category' => $category]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Role model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $category  = LsYii::getGetValue('category');
        Role::setMenus($category);
        $model = $this->findModel($id);
        if($model->is_system)
        {
            return $this->redirect(['index' ,'category'=>$category  , 'message'=>LsYii::gT('该分类还有子项，不能被删除') , 'type'=>2]);
        }
        else
        {
            $model->delete();
            return $this->redirect(['index','category'=>$category , 'message'=>  LsYii::gT('删除成功')]);
        }
    }

    /**
     * Finds the Role model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Role the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Role::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
