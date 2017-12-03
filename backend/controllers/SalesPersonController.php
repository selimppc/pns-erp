<?php

namespace backend\controllers;

use Yii;
use backend\models\SalesPerson;
use backend\models\SalesPersonSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\web\Response;

/**
 * SalesPersonController implements the CRUD actions for SalesPerson model.
 */
class SalesPersonController extends Controller
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
     * Lists all SalesPerson models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SalesPersonSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SalesPerson model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionFindCommission(){
        if (Yii::$app->request->isAjax) {

            Yii::$app->response->format = Response::FORMAT_JSON;
            $session = Yii::$app->session;
            $response = [];

            $response['commission_value'] = '';
            $response['commission'] = '';
            $response['result'] = 'error';

            if(!empty($_POST['sales_person_id']))
            {
                $sales_person_id = $_POST['sales_person_id'];

                $model = SalesPerson::find()->where(['id'=>$sales_person_id])->one();

                if(!empty($model))
                {
                    $response['commission'] = '<label>Commission :: ' .$model->commission . '%</label>';
                    $response['commission_value'] = $model->commission;
                    $response['result'] = 'success';
                } 
            }
            

            return $response;
        }
    }

    /**
     * Creates a new SalesPerson model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SalesPerson();

        if ($model->load(Yii::$app->request->post()) ) {

            $transaction = \Yii::$app->db->beginTransaction();

            try {

                if($model->save()){

                    $transaction->commit();

                    // Set success data
                    \Yii::$app->getSession()->setFlash('success', 'Successfully Inserted');

                    return $this->redirect(['view', 'id' => $model->id]);

                }

                

            }catch (\Exception $e) {

                \Yii::$app->getSession()->setFlash('success', $e->getMessage());
                $transaction->rollBack();
            }

            
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing SalesPerson model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $transaction = \Yii::$app->db->beginTransaction();

            try {

                if($model->save()){

                    $transaction->commit();

                    // Set success data
                    \Yii::$app->getSession()->setFlash('success', 'Successfully Updated');

                    return $this->redirect(['view', 'id' => $model->id]);        
                }                

            }catch (\Exception $e) {

                \Yii::$app->getSession()->setFlash('success', $e->getMessage());
                $transaction->rollBack();
            }

            
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing SalesPerson model.
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
     * Finds the SalesPerson model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SalesPerson the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SalesPerson::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
