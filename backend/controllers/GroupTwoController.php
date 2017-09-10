<?php

namespace backend\controllers;

use Yii;
use backend\models\GroupTwo;
use backend\models\GroupTwoSearch;
use backend\models\GroupOne;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * GroupTwoController implements the CRUD actions for GroupTwo model.
 */
class GroupTwoController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all GroupTwo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GroupTwoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single GroupTwo model.
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
     * Creates a new GroupTwo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new GroupTwo();

        $group_one_data = ArrayHelper::map(GroupOne::find()->all(), 'id', 'title');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            // Set success data
            \Yii::$app->getSession()->setFlash('success', 'Successfully Inserted');

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'group_one_data' => $group_one_data
            ]);
        }
    }

    /**
     * Updates an existing GroupTwo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $group_one_data = ArrayHelper::map(GroupOne::find()->all(), 'id', 'title');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            // Set success data
            \Yii::$app->getSession()->setFlash('success', 'Successfully Updated');

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'group_one_data' => $group_one_data
            ]);
        }
    }

    /**
     * Deletes an existing GroupTwo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the GroupTwo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return GroupTwo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GroupTwo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
