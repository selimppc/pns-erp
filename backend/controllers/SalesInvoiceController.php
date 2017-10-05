<?php

namespace backend\controllers;

use Yii;
use backend\models\SmHead;
use backend\models\SmHeadSearch;

use backend\models\SmDetail;
use backend\models\SmDetailSearch;

use backend\models\TransactionCode;
use backend\models\Currency;

use backend\models\SmBatchSale;

use yii\web\Controller;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Model;

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
     * Lists all SmHead models.
     * @return mixed
     */
    public function actionDirectSales()
    {
        $searchModel = new SmHeadSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,'direct_sale');
        $dataProvider->pagination->pageSize=30;

        return $this->render('direct_sale_index', [
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
        $model = $this->findModel($id);

        if(!empty($model)){

            $sm_details_r = SmDetail::find()->where(['sm_head_id' => $model->id])->all();

            return $this->render('view', [
                'model' => $model,
                'sm_details_r' => $sm_details_r
            ]);

        }

        
    }

    /**
     * @param $id
     * @return string
     */
    public function actionViewDirectSales($id)
    {
        $model = $this->findModel($id);

        if(!empty($model)){

            $sm_details_r = SmDetail::find()->where(['sm_head_id' => $model->id])->all();

            return $this->render('view_direct_sales', [
                'model' => $model,
                'sm_details_r' => $sm_details_r
            ]);

        }

        
    }

    /**
     * Creates a new SmHead model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        // generate Invoice Number               
        $invoice_number = TransactionCode::generate_transaction_number('IN--');
        
        if(empty($invoice_number)){
            $invoice_number = '';
        }
        

        $modelSmHead = new SmHead;
        $modelsSmDetail = [new SmDetail];

        $modelSmHead->scenario = 'create';

        // Set Default Data
        $modelSmHead->sm_number = $invoice_number; 
        $modelSmHead->tax_rate ='0.00';
        $modelSmHead->tax_amount ='0.00';
        $modelSmHead->discount_rate ='0.00';
        $modelSmHead->discount_amount ='0.00';
        $modelSmHead->prime_amount ='0.00';
        $modelSmHead->net_amount ='0.00';
        $modelSmHead->currency_id = 1;

        $currecy_data = Currency::find()->where(['id'=>$modelSmHead->currency_id])->one();

        if(!empty($currecy_data)){
            $modelSmHead->exchange_rate = $currecy_data->exchange_rate;
        }

        $modelSmHead->branch_id = 1;

        if ($modelSmHead->load(Yii::$app->request->post())) {

            $modelsSmDetail = Model::createMultiple(SmDetail::classname());
            Model::loadMultiple($modelsSmDetail, Yii::$app->request->post());

            // validate all models
            $valid = $modelSmHead->validate();
            $valid = Model::validateMultiple($modelsSmDetail) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();

                try {
                    $modelSmHead->status = 'open';
                    if ($flag = $modelSmHead->save(false)) {
                        foreach ($modelsSmDetail as $modelSmDetail) {

                            $modelSmDetail->sm_head_id = $modelSmHead->id;

                            $modelSmDetail->uom_quantity = '0';
                            $modelSmDetail->bonus_quantity = '0';
                            $modelSmDetail->row_amount = $modelSmDetail->quantity * $modelSmDetail->rate;

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

                        // Update SM Head prime amount & net amount
                        SmHead::update_sale_invoice_amount($modelSmHead->id);

                        // Set success data
                        \Yii::$app->getSession()->setFlash('success', 'Successfully Inserted');

                        
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $modelSmHead->id]);
                    }
                } catch (\Exception $e) {

                    // Set error data
                    \Yii::$app->getSession()->setFlash('error', $e->getMessage());

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
     * @return string
     */
    public function actionCreateDirectSales(){

        // generate Invoice Number               
        $invoice_number = TransactionCode::generate_transaction_number('DS--');
        
        if(empty($invoice_number)){
            $invoice_number = '';
        }

        $model = new SmHead();

        $model->scenario = 'create_direct_sales';

        // Set Default Data
        $model->currency_id = 1;
        $currecy_data = Currency::find()->where(['id'=>$model->currency_id])->one();
        if(!empty($currecy_data)){
            $model->exchange_rate = $currecy_data->exchange_rate;
        }
        $model->branch_id = 1;
        $model->sm_number = $invoice_number;

        if ($model->load(Yii::$app->request->post())) {

            $model->tax_rate = 0.00;
            $model->tax_amount = 0.00;
            $model->discount_rate = 0.00;
            $model->discount_amount = 0.00;
            $model->prime_amount = $model->net_amount;
            $model->status = 'open';


            $transaction = \Yii::$app->db->beginTransaction();

            try {

                $transaction->commit();

                if($model->save()){

                    // Update transaction code data
                    $update_transaction = TransactionCode::update_transaction_number('DS--');

                    if($update_transaction){
                        echo 'successfully updated';
                    }else{
                        echo 'successfully not updated';
                    }

                    // Set success data
                    \Yii::$app->getSession()->setFlash('success', 'Successfully Inserted');

                    return $this->redirect(['view-direct-sales', 'id' => $model->id]);
                } else{

                    $model->tax_amount = 0.00;
            
                    return $this->render('create_direct_sales', [
                        'model' => $model,
                    ]);
                    
                }

            }catch (\Exception $e) {

                \Yii::$app->getSession()->setFlash('error', $e->getMessage());
                $transaction->rollBack();
            }

            
            
        } else {

            $model->tax_amount = 0.00;
            
            return $this->render('create_direct_sales', [
                'model' => $model,
            ]);
        }

    }

    /**
     * Updates an existing SmHead model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
       
        $modelSmHead = $this->findModel($id);
        $modelsSmDetail = $modelSmHead->smDetails;

        $modelSmHead->scenario = 'create';

        if ($modelSmHead->load(Yii::$app->request->post())) {

            $oldIDs = ArrayHelper::map($modelsSmDetail, 'id', 'id');
            $modelsSmDetail = Model::createMultiple(SmDetail::classname(), $modelsSmDetail);
            Model::loadMultiple($modelsSmDetail, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsSmDetail, 'id', 'id')));

            // validate all models
            $valid = $modelSmHead->validate();
            $valid = Model::validateMultiple($modelsSmDetail) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $modelSmHead->save(false)) {
                        if (!empty($deletedIDs)) {
                            SmDetail::deleteAll(['id' => $deletedIDs]);
                        }
                        foreach ($modelsSmDetail as $modelSmDetail) {
                            $modelSmDetail->sm_head_id = $modelSmHead->id;
                            $modelSmDetail->uom_quantity = '0';
                            $modelSmDetail->bonus_quantity = '0';
                            $modelSmDetail->row_amount = $modelSmDetail->quantity * $modelSmDetail->rate;

                            if (! ($flag = $modelSmDetail->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();

                       // Update SM Head prime amount & net amount
                        SmHead::update_sale_invoice_amount($modelSmHead->id);

                        // Set success data
                        \Yii::$app->getSession()->setFlash('success', 'Successfully Updated');

                        return $this->redirect(['view', 'id' => $modelSmHead->id]);
                    }
                } catch (\Exception $e) {

                    // Set success data
                    \Yii::$app->getSession()->setFlash('error', $e->getMessage());

                    $transaction->rollBack();
                }
            }
        }

        return $this->render('update', [
            'modelSmHead' => $modelSmHead,
            'modelsSmDetail' => (empty($modelsSmDetail)) ? [new SmDetail] : $modelsSmDetail
        ]);

    }


    /**
     * @param $id
     * @return string|\yii\web\Response
     */
    public function actionUpdateDirectSales($id){

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            // Set success data
            \Yii::$app->getSession()->setFlash('success', 'Successfully Updated');

            return $this->redirect(['view-direct-sales', 'id' => $model->id]);
        } else {
            return $this->render('update_direct_sales', [
                'model' => $model,
            ]);
        }

    }

    /**
     * @param $id
     * @return \yii\web\Response
     */
    public function actionConfirm($id)
    {
        $model = $this->findModel($id);

        if($model)
        {
            try{

                // send sales data into the table sm_batch_sale

                $result = \Yii::$app->db->createCommand("CALL sp_sm_do_confirm(:sm_head_id, :user_id)")
                    ->bindValue(':sm_head_id' , $model->id )
                    ->bindValue(':user_id', Yii::$app->user->id)
                    ->execute();

                $sm_details = SmDetail::find()->where(['sm_head_id' => $model->id])->all();

                if(!empty($sm_details)){

                    foreach($sm_details as $sm_d){

                        $sm_batch_sale_model = new SmBatchSale();

                        $sm_batch_sale_model->sm_head_id = $model->id;
                        $sm_batch_sale_model->product_id = $sm_d->product_id;
                        $sm_batch_sale_model->batch_number = '';
                        $sm_batch_sale_model->expire_date = $model->date;
                        $sm_batch_sale_model->uom = $sm_d->uom;
                        $sm_batch_sale_model->quantity = $sm_d->quantity;
                        $sm_batch_sale_model->bonus_quantity = $sm_d->bonus_quantity;
                        $sm_batch_sale_model->sell_rate = '';
                        $sm_batch_sale_model->rate = $sm_d->rate;
                        $sm_batch_sale_model->tax_rate = $model->tax_rate;
                        $sm_batch_sale_model->tax_amount = $model->tax_amount;
                        $sm_batch_sale_model->line_amount = $model->net_amount;
                        $sm_batch_sale_model->courency_id = $model->currency_id;
                        $sm_batch_sale_model->exchange_rate = $model->exchange_rate;
                        $sm_batch_sale_model->reference_code = $model->reference_code;

                        $sm_batch_sale_model->save();
                    }

                } 

                \Yii::$app->getSession()->setFlash('success', 'Sales Confirmed Successfully !');
            }catch (\Exception $e)
            {
                \Yii::$app->getSession()->setFlash('error', $e->getMessage());
            }
        }

        return $this->redirect(['index']);
    }


    /**
     * @param $id
     * @return \yii\web\Response
     */
    public function actionCancel($id)
    {
        $model = $this->findModel($id);

        if($model){

            $model->status = 'cancel';

            $valid = $model->validate();
            if($valid){

                // Set success data
                \Yii::$app->getSession()->setFlash('success', 'Successfully Cancel');

                $model->save();    
            }else{
                print_r($model->getErrors());
                exit();
            }
            

           
        }

        return $this->redirect(['index']);
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
