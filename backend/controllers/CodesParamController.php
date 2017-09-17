<?php

namespace backend\controllers;

use Yii;
use backend\models\CodesParam;
use backend\models\CodesParamSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CodesParamController implements the CRUD actions for CodesParam model.
 */
class CodesParamController extends Controller
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



    public function actionCodesParamsOption($type){

        if(isset(\Yii::$app->params[$type]) && !empty(\Yii::$app->params[$type])){
            
            $codes_params_help_text =\Yii::$app->params[$type];
        }else{
            $codes_params_help_text = '';
        }

        $model = new CodesParam();

        $model->type = $type;

        $searchModel = new CodesParamSearch();
        $searchModel->type = $type;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider->pagination->pageSize=30;



        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            // Set success data
            \Yii::$app->getSession()->setFlash('success', 'Successfully Inserted');

            return $this->render('codes_params_option', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'model' => $model,
                'codes_params_help_text' => $codes_params_help_text
            ]);

        } else {

            return $this->render('codes_params_option', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'model' => $model,
                'codes_params_help_text' => $codes_params_help_text
            ]);
        }

        

    }


    public function actionUpdateCodesParams($id,$type){

        if(isset(\Yii::$app->params[$type]) && !empty(\Yii::$app->params[$type])){            
            $codes_params_help_text =\Yii::$app->params[$type];
        }else{
            $codes_params_help_text = '';
        }

        $model = $this->findModel($id);

        $model->type = $type;

        $searchModel = new CodesParamSearch();
        $searchModel->type = $type;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            // Set success data
            \Yii::$app->getSession()->setFlash('success', 'Successfully Updated');
            
            return $this->render('codes_params_option', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'model' => $model,
                'codes_params_help_text' => $codes_params_help_text
            ]);

        } else {
            
            return $this->render('codes_params_option', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'model' => $model,
                'codes_params_help_text' => $codes_params_help_text
            ]);

        }

    }

    public function actionViewCodesParams($id,$type)
    {
        $model = $this->findModel($id);

        $searchModel = new CodesParamSearch();
        $searchModel->type = $type;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider->pagination->pageSize=30;

        return $this->render('view_codes_params', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model
        ]);
    }


    /**
     * Lists all CodesParam models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CodesParamSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider->pagination->pageSize=30;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CodesParam model.
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
     * Creates a new CodesParam model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CodesParam();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CodesParam model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CodesParam model.
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
     * Finds the CodesParam model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CodesParam the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CodesParam::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
