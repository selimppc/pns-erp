<?php

namespace backend\controllers;

use Yii;
use backend\models\TransactionCode;
use backend\models\TransactionCodeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TransactionCodeController implements the CRUD actions for TransactionCode model.
 */
class TransactionCodeController extends Controller
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
     * Lists all TransactionCode models.
     * @return mixed
     */
    public function actionIndex($type='')
    {
        $model = new TransactionCode();

        $model->type = $type;
        $model->last_number = '0';
        $model->increment = '1';

        $searchModel = new TransactionCodeSearch();
        $searchModel->type = $type;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $model = new TransactionCode();
            $model->last_number = '0';
            $model->increment = '1';

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'model' => $model
            ]);

        }else{

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'model' => $model
            ]);

        }

        
    }

    /**
     * Displays a single TransactionCode model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id,$type='')
    {

        $model = $this->findModel($id);

        $searchModel = new TransactionCodeSearch();
        $searchModel->type = $type;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('view', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'model' => $model
            ]);

        
    }

    /**
     * Creates a new TransactionCode model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($type='')
    {
        $model = new TransactionCode();

        $model->type = $type;
        $model->last_number = '0';
        $model->increment = '1';

        $searchModel = new TransactionCodeSearch();
        $searchModel->type = $type;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
            $model = new TransactionCode();
            $model->type = $type;
            $model->last_number = '0';
            $model->increment = '1';

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'model' => $model
            ]);

        } else {
            
            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'model' => $model
            ]);

        }
    }

    /**
     * Updates an existing TransactionCode model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id,$type='')
    {
        $model = $this->findModel($id);

        $model->type = $type;

        $searchModel = new TransactionCodeSearch();
        $searchModel->type = $type;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'model' => $model
            ]);

        } else {
            
            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'model' => $model
            ]);

        }
    }

    /**
     * Deletes an existing TransactionCode model.
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
     * Finds the TransactionCode model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TransactionCode the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TransactionCode::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
