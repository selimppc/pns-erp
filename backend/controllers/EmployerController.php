<?php

namespace backend\controllers;

use Yii;
use backend\models\Employer;
use backend\models\EmployerSearch;
use backend\models\TransactionCode;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EmployerController implements the CRUD actions for Employer model.
 */
class EmployerController extends Controller
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
     * Lists all Employer models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EmployerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Employer model.
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
     * Creates a new Employer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Employer();

        if ($model->load(Yii::$app->request->post()) ) {

            $transaction = \Yii::$app->db->beginTransaction();

            try {

                if($model->save()){

                    // Update serial number
                    TransactionCode::update_transaction_number('EMP-');

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

            // Generate serial number
            $serial_number = TransactionCode::generate_transaction_number('EMP-');
        
            if(empty($serial_number)){
                $serial_number = '';
            }

            $model->employer_code = $serial_number;

            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Employer model.
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
     * Deletes an existing Employer model.
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
     * Finds the Employer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Employer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Employer::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
