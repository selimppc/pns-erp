<?php

namespace backend\controllers;

use Yii;
use backend\models\SmHead;
use backend\models\SmHeadSearch;

use backend\models\SmDetail;

use yii\web\Controller;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Model;

use backend\models\TransactionCode;
use backend\models\Currency;

use backend\models\SmBatchSale;

/**
 * SmHeadController implements the CRUD actions for SmHead model.
 */
class SalesReturnController extends Controller
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

    public function actionIndex()
    {

        // All data
        $searchModel = new SmHeadSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,'return');
        $dataProvider->pagination->pageSize=30;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionChooseInvoice()
    {

        if(isset($_POST['invoice']))
        {
            
            $id = $_POST['invoice'];

            return $this->redirect(array('sales-return/create', 'invoice_id' => $id));

        }


        return $this->render('choose_invoice');

    }

    /**
     * Creates a new SmHead model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($invoice_id)
    {

        $modelSmHead = $this->findModel($invoice_id);
        $modelsSmDetail = $modelSmHead->smDetails;

    	// generate Invoice Number               
        $invoice_number = TransactionCode::generate_transaction_number('SR--');
        
        if(empty($invoice_number)){
            $invoice_number = '';
        }

        $modelSmHead->scenario = 'sales_return';

        // Set Default Data
        $modelSmHead->sm_number = $invoice_number; 
        
        if ($modelSmHead->load(Yii::$app->request->post())) {

            // Assign new sales return form
            $modelSmHead_sales_return = new SmHead;

            $modelSmHead_sales_return->sm_number = $invoice_number;
            $modelSmHead_sales_return->note = $modelSmHead->note;
            $modelSmHead_sales_return->date = $modelSmHead->date;
            $modelSmHead_sales_return->pay_terms = $modelSmHead->pay_terms;
            $modelSmHead_sales_return->currency_id = $modelSmHead->currency_id;
            $modelSmHead_sales_return->exchange_rate = $modelSmHead->exchange_rate;
            $modelSmHead_sales_return->tax_amount = $modelSmHead->tax_amount;
            $modelSmHead_sales_return->branch_id = $modelSmHead->branch_id;
            $modelSmHead_sales_return->customer_id = $modelSmHead->customer_id;
            $modelSmHead_sales_return->sales_person_id = $modelSmHead->sales_person_id;
            $modelSmHead_sales_return->discount_amount = $modelSmHead->discount_amount;
            
            $modelsSmDetail = Model::createMultiple(SmDetail::classname());
            Model::loadMultiple($modelsSmDetail, Yii::$app->request->post());

            // validate all models
            $valid = $modelSmHead_sales_return->validate();
            $valid = Model::validateMultiple($modelsSmDetail) && $valid;


            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();

                try {

                    $modelSmHead_sales_return->status = 'open';
                    $modelSmHead_sales_return->doc_type = 'return';
                    $modelSmHead_sales_return->reference_code = $invoice_number;
                    $modelSmHead_sales_return->sign = '1';
                   
                    if ($flag = $modelSmHead_sales_return->save(false)) {
                        foreach ($modelsSmDetail as $modelSmDetail) {

                            $modelSmDetail->sm_head_id = $modelSmHead_sales_return->id;

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
                        $update_transaction = TransactionCode::update_transaction_number('SR--');

                        if($update_transaction){
                            echo 'successfully updated';
                        }else{
                            echo 'successfully not updated';
                        }

                        // Update SM Head prime amount & net amount
                        SmHead::update_sale_invoice_amount($modelSmHead_sales_return->id);

                        $sm_details = SmDetail::find()->where(['sm_head_id' => $modelSmHead_sales_return->id])->all();

                        if(!empty($sm_details)){

                            foreach($sm_details as $sm_d){

                                $sm_batch_sale_model = new SmBatchSale();

                                $sm_batch_sale_model->sm_head_id = $modelSmHead_sales_return->id;
                                $sm_batch_sale_model->product_id = $sm_d->product_id;
                                $sm_batch_sale_model->batch_number = $sm_d->batch_number;
                                $sm_batch_sale_model->expire_date = '2023-01-22';
                                $sm_batch_sale_model->uom = $sm_d->uom;
                                $sm_batch_sale_model->quantity = $sm_d->quantity;
                                $sm_batch_sale_model->bonus_quantity = $sm_d->bonus_quantity;
                                $sm_batch_sale_model->sell_rate = $sm_d->sell_rate;
                                $sm_batch_sale_model->rate = $sm_d->rate;
                                $sm_batch_sale_model->tax_rate = $modelSmHead_sales_return->tax_rate;
                                $sm_batch_sale_model->tax_amount = $modelSmHead_sales_return->tax_amount;
                                $sm_batch_sale_model->line_amount = $modelSmHead_sales_return->net_amount;
                                $sm_batch_sale_model->courency_id = $modelSmHead_sales_return->currency_id;
                                $sm_batch_sale_model->exchange_rate = $modelSmHead_sales_return->exchange_rate;
                                $sm_batch_sale_model->reference_code = $modelSmHead_sales_return->reference_code;

                                $sm_batch_sale_model->save();
                            }

                        }

                        // Set success data
                        \Yii::$app->getSession()->setFlash('success', 'Successfully Inserted');

                        
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $modelSmHead_sales_return->id]);
                    }
                } catch (\Exception $e) {

                    // Set error data
                    print_r($e->getMessage());
                    exit();
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
     * @return \yii\web\Response
     */
    public function actionConfirm($id)
    {
        $model = $this->findModel($id);

        if($model)
        {
            try{

                // send sales data into the table sm_batch_sale

                $result = \Yii::$app->db->createCommand("CALL sp_sm_order_return(:pID, :pUserId)")
                    ->bindValue(':pID' , $model->id )
                    ->bindValue(':pUserId', Yii::$app->user->id)
                    ->execute();

                 

                \Yii::$app->getSession()->setFlash('success', 'Sales Confirmed Successfully !');
            }catch (\Exception $e)
            {
                \Yii::$app->getSession()->setFlash('error', $e->getMessage());
            }
        }

        return $this->redirect(['index']);
        
        /*return $this->goBack((!empty(Yii::$app->request->referrer) ? Yii::$app->request->referrer : null));*/
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