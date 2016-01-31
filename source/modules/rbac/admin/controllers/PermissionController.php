<?php

namespace source\modules\rbac\admin\controllers;

use Yii;
use source\LsYii;
use source\modules\rbac\models\Permission;
use source\modules\rbac\models\search\PermissionSearch;
use source\core\back\BackController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PermissionController implements the CRUD actions for Permission model.
 */
class PermissionController extends BackController
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
     * Lists all Permission models.
     * @return mixed
     */
    public function actionIndex($category)
    {
        Permission::setMenus($category);
        $searchModel = new PermissionSearch();
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
     * 控制器权限设置
     */
    public function actionController()
    {
        return $this->redirect(['index' , 'category'=>'controller']);
    }
    
    /**
     * 系统权限
     * @return type
     */
    public function actionSystem()
    {
        return $this->redirect(['index' , 'category'=>'system']);
    }

    /**
     * Displays a single Permission model.
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
     * Creates a new Permission model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($category)
    {
        Permission::setMenus($category);
        $model = new Permission();
        $model->category = $category;
        if ($model->load(Yii::$app->request->post())) {
            $model->save();
            return $this->redirect(['index', 'category' => $category]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Permission model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id , $category)
    {
        Permission::setMenus($category);
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
     * Deletes an existing Permission model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id , $category)
    {
        $this->findModel($id)->delete();
        
        return $this->redirect(['index' , 'category'=>$category , 'message'=>  LsYii::gT('删除成功')]);
    }

    /**
     * Finds the Permission model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Permission the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Permission::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
