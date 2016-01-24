<?php

namespace source\modules\dict\admin\controllers;

use Yii;
use source\LsYii;
use source\modules\dict\models\Dict;
use source\modules\dict\models\search\DictSearch;
use source\core\back\BackController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DictController implements the CRUD actions for Dict model.
 */
class DictController extends BackController
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
     * Lists all Dict models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->setMenus(43, "字典管理");
        $category_id = LsYii::getGetValue('category_id' , 'sex');
        $searchModel = new DictSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'category_id'=>$category_id
        ]);
    }

    /**
     * Displays a single Dict model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Dict model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->setMenus(43, "添加字典");
        $category_id = LsYii::getGetValue('category_id' , 'sex');
        $model = new Dict();
        $model->category_id = $category_id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index' , 'category_id'=>$category_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'category_id'=>$category_id
            ]);
        }
    }

    /**
     * Updates an existing Dict model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $category_id = LsYii::getGetValue('category_id' , 'sex');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'category_id' => $category_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'category_id'=>$category_id
            ]);
        }
    }

    /**
     * Deletes an existing Dict model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $category_id = LsYii::getGetValue('category_id' , 'sex');
        $this->findModel($id)->delete();

        return $this->redirect(['index' , 'category_id'=>$category_id]);
    }

    /**
     * Finds the Dict model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Dict the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Dict::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
