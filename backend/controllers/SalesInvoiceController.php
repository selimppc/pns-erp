<?php

namespace backend\controllers;

use Yii;
use backend\models\SmHead;
use backend\models\SmHeadSearch;

use backend\models\SmDetail;
use backend\models\SmDetailSearch;

use backend\models\TransactionCode;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SmHeadController implements the CRUD actions for SmHead model.
 */
class SalesInvoiceController extends Controller
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
     * Lists all SmHead models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SmHeadSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize=30;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SmHead model.
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
     * Creates a new SmHead model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        // generate purchase Order Number
               
        $invoice_number = TransactionCode::generate_transaction_number('IN--');
        
        if(empty($invoice_number)){
            $invoice_number = '';
        }
        

        $modelSmHead = new SmHead;
        $modelsSmDetail = [new SmDetail];

        $modelSmHead->sm_number = $invoice_number; 
        $modelSmHead->tax_rate ='0.00';
        $modelSmHead->tax_amount ='0.00';
        $modelSmHead->discount_rate ='0.00';
        $modelSmHead->discount_amount ='0.00';
        $modelSmHead->prime_amount ='0.00';
        $modelSmHead->net_amount ='0.00';

        if ($modelSmHead->load(Yii::$app->request->post())) {

            $modelsSmDetail = Model::createMultiple(SmDetail::classname());
            Model::loadMultiple($modelsSmDetail, Yii::$app->request->post());

            // validate all models
            $valid = $modelSmHead->validate();
            $valid = Model::validateMultiple($modelsSmDetail) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();

                try {
                    $modelSmHead->status = 'confirmed';
                    if ($flag = $modelSmHead->save(false)) {
                        foreach ($modelsSmDetail as $modelSmDetail) {
                            $modelSmDetail->sm_head_id = $modelSmHead->id;

                            if (! ($flag = $modelSmDetail->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }

                    if ($flag) {

                        // Update transaction code data
                        $update_transaction = TransactionCode::update_transaction_number('IN--');

                        if($update_transaction){
                            echo 'successfully updated';
                        }else{
                            echo 'successfully not updated';
                        }

                        // Update Purchase Order Head prime amount & net amount
                        SmHead::update_sale_invoice_amount($modelSmHead->id);

                        // Set success data
                        \Yii::$app->getSession()->setFlash('success', 'Successfully Inserted');

                        
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $modelSmHead->id]);
                    }
                } catch (\Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('create', [
            'modelSmHead' => $modelSmHead,
            'modelsSmDetail' => (empty($modelsSmDetail)) ? [new SmDetail] : $modelsSmDetail
        ]);
    }

    /**
     * Updates an existing SmHead model.
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
     * Deletes an existing SmHead model.
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
     * Finds the SmHead model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SmHead the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SmHead::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
