<?php

namespace source\modules\dict\admin\controllers;

use Yii;
use source\LsYii;
use source\modules\dict\models\DictCategory;
use source\modules\dict\models\search\DictCategorySearch;
use source\core\back\BackController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use source\modules\dict\models\Dict;

/**
 * DictCategoryController implements the CRUD actions for DictCategory model.
 */
class DictcategoryController extends BackController
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
     * Lists all DictCategory models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->setMenus(43, "字典分类管理");
        $searchModel = new DictCategorySearch();
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
     * Displays a single DictCategory model.
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
     * Creates a new DictCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->setMenus(43, "添加字典分类");
        $model = new DictCategory(['scenario'=>'create']);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing DictCategory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $this->setMenus(43, "修改字典分类");
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
     * Deletes an existing DictCategory model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->setMenus(43, "删除字典分类");
        if( Dict::findAll(['category_id'=>$id]) )
        {
            return $this->redirect(['index' , 'message'=>LsYii::gT('该分类还有子项，不能被删除') , 'type'=>2]);
        }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the DictCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return DictCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DictCategory::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
