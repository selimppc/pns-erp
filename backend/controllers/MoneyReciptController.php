<?php


namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use backend\models\VwSmCustomerReceivable;
use backend\models\VwSmCustomerReceivableSearch;
use backend\models\TransactionCode;
use backend\models\SmHead;
use backend\models\Currency;
use backend\models\Customer;

use backend\models\VwSmMrReceive;
use backend\models\SmInvoiceAllocation;


class MoneyReciptController extends Controller{


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


    public function actionIndex(){

        $searchModel = new VwSmCustomerReceivableSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider->pagination->pageSize=30;


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }

    public function actionShow($sm_head_id='',$customer_id ='', $branch_id='')
    {

        $customer = Customer::find()->where(['id' => $customer_id])->one();
        $model = SmHead::find()->where(['customer_id' => $customer_id])->andWhere(['doc_type' => 'receipt'])->all();

        return $this->render('show-money-receipt',[
                    'model' => $model,
                    'customer' => $customer
            ]);
    }


    /**
     * @param $id
     * @return \yii\web\Response
     */
    public function actionCancel($id)
    {
        $model = SmHead::find()->where(['id' => $id])->one();

        if(!empty($model))
        {
            $transaction = \Yii::$app->db->beginTransaction();

            try {

                $model->status = 'cancel';
                $model->save();

                $sm_invoice_allocation = SmInvoiceAllocation::find()->where(['sm_head_id' => $id])->one();

                if(!empty($sm_invoice_allocation))
                {
                    $sm_invoice_allocation->delete();
                }

                \Yii::$app->getSession()->setFlash('success', 'Money Receipt Cancel Successfully !');
                //commit the changes
                $transaction->commit();

            } catch (\Exception $e)
            {

                \Yii::$app->getSession()->setFlash('error', $e->getMessage());
                $transaction->rollBack();
                
            }
            
        }

        return $this->redirect(['index']);
    }

    /**
     * @param $id
     * @return \yii\web\Response
     */
    public function actionApproved($id)
    {
        $model = SmHead::find()->where(['id' => $id])->one();

        if(!empty($model))
        {
            try{

                $result = \Yii::$app->db->createCommand("CALL sp_sm_mr_to_gl(:pID, :pUserId)")
                    ->bindValue(':pID' , $model->id )
                    ->bindValue(':pUserId', Yii::$app->user->id)
                    ->execute();

                \Yii::$app->getSession()->setFlash('success', 'Money Receipt Confirmed Successfully !');

            }catch (\Exception $e)
            {
                \Yii::$app->getSession()->setFlash('error', $e->getMessage());
            }    
        }

        return $this->redirect(['index']);
    }


    public function actionCreateMoneyReceipt($sm_head_id='',$customer_id ='', $branch_id='')
    {

        // Generate Transaction Code
        $receipt_number = TransactionCode::generate_transaction_number('MR--');

        $data = VwSmCustomerReceivable::find()->where(['sm_head_id' => $sm_head_id])->andWhere(['customer_id' => $customer_id])->one();

        if(!empty($data))
        {
            $model = new SmHead();

            $model->scenario = 'create_money_receipt';

            $model->sm_number = $receipt_number;
            $model->date = Date('Y-m-d');
            $model->customer_id = $data->customer_id;
            $model->money_receipt_customer_name = $data->customer_name;
            $model->status = 'open';
            $model->branch_id = $data->branch_id;
            $model->money_receipt_branch = isset($data->branch)?$data->branch->title:'';
            $model->currency_id = 1;

            // Currency Rate
            $currency_data = Currency::find()->where(['id' => $model->currency_id])->one();

            if(!empty($currency_data)){           
                $model->exchange_rate = number_format($currency_data->exchange_rate,2);
            }


            // get due money receipt list
            $unpaid_money_received = VwSmMrReceive::find()->where(['customer_id' => $customer_id])->andWhere(['branch_id' => $branch_id])->all();



            // Save data
            if ($model->load(Yii::$app->request->post()))
            {
                // validate all models
                $valid = $model->validate();

                if($valid)
                {
                    $transaction = \Yii::$app->db->beginTransaction();

                    try {

                        $model->doc_type = 'receipt';

                        $all_post = Yii::$app->request->post();

                        $net_amount = 0;

                        if(!empty($all_post['sm_invnumber']))
                        {
                            for($i=0;$i<count($all_post['sm_invnumber']);$i++)
                            {
                                $net_amount+= $all_post['sm_amount'][$i];
                            }
                        }

                        $model->net_amount = $net_amount;

                        if($model->save())
                        {

                            // Update money receipt
                            $update_money_receipt = TransactionCode::update_transaction_number('MR--');


                            // sm_invoice_allocation
                        
                            if(!empty($all_post['sm_invnumber']))
                            {
                                for($i=0;$i<count($all_post['sm_invnumber']);$i++)
                                {
                                    $sm_invoice_allocation = new SmInvoiceAllocation();

                                    $sm_invoice_allocation->sm_head_id = $model->id;
                                    $sm_invoice_allocation->invoice_number = $all_post['sm_invnumber'][$i];
                                    $sm_invoice_allocation->amount = $all_post['sm_amount'][$i];

                                    $sm_invoice_allocation->save();
                                }
                            }


                        }
                        // Set success data
                        \Yii::$app->getSession()->setFlash('success', 'Successfully Inserted');

                        $transaction->commit();

                        return $this->redirect(['index']);

                    }catch (\Exception $e) {

                        // Set error data
                        \Yii::$app->getSession()->setFlash('error', $e->getMessage());

                        $transaction->rollBack();
                    }

                }else{
                    print_r($model->getErrors());
                    exit();
                }
                
            }

            return $this->render('create_money_receipt',[
                'model' => $model,
                'data' => $data,
                'unpaid_money_received' => $unpaid_money_received
            ]);

        }

    }

}