<?php

namespace backend\controllers;


use Yii;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;
use backend\models\Model;
use yii\web\Controller;

use backend\models\PpPurchaseHead;
use backend\models\PpPurchaseDetail;
use backend\models\PpPurchaseHeadSearch;
use backend\models\TransactionCode;
use backend\models\Currency;

class TestController extends Controller{

	public function actionCreate()
    {
       
       $this->layout='test_layout';
        // generate purchase Order Number
               
        $po_order_number = TransactionCode::generate_transaction_number('PO--');
        
        if(empty($po_order_number)){
            $po_order_number = '';
        }
        

        $modelPurchaseHead = new PpPurchaseHead;
        $modelsPurchaseDetail = [new PpPurchaseDetail];

        // Set Defult Data
        $modelPurchaseHead->po_order_number = $po_order_number; 
        $modelPurchaseHead->status = 'open'; 
        $modelPurchaseHead->tax_rate ='0.00';
        $modelPurchaseHead->tax_amount ='0.00';
        $modelPurchaseHead->discount_rate ='0.00';
        $modelPurchaseHead->discount_amount ='0.00';
        $modelPurchaseHead->prime_amount ='0.00';
        $modelPurchaseHead->net_amount ='0.00';
        $modelPurchaseHead->branch_id = 1;
        $modelPurchaseHead->currency_id = 1;

        // Currency Rate
        $currency_data = Currency::find()->where(['id' => $modelPurchaseHead->currency_id])->one();

        if(!empty($currency_data)){           
            $modelPurchaseHead->exchange_rate = $currency_data->exchange_rate;
        }


        if ($modelPurchaseHead->load(Yii::$app->request->post())) {

            $modelsPurchaseDetail = Model::createMultiple(PpPurchaseDetail::classname());
            Model::loadMultiple($modelsPurchaseDetail, Yii::$app->request->post());

            // validate all models
            $valid = $modelPurchaseHead->validate();
            $valid = Model::validateMultiple($modelsPurchaseDetail) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();

                try {
                    $modelPurchaseHead->status = 'open';
                    if ($flag = $modelPurchaseHead->save(false)) {
                        foreach ($modelsPurchaseDetail as $modelPurchaseDetail) {
                            $modelPurchaseDetail->pp_purchase_head_id = $modelPurchaseHead->id;

                            $modelPurchaseDetail->row_amount = $modelPurchaseDetail->quantity * $modelPurchaseDetail->purchase_rate;

                            $modelPurchaseDetail->unit_quantity = 1;

                            if (! ($flag = $modelPurchaseDetail->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }

                    if ($flag) {

                        // Update transaction code data
                        $update_transaction = TransactionCode::update_transaction_number('PO--');

                        if($update_transaction){
                            echo 'successfully updated';
                        }else{
                            echo 'successfully not updated';
                        }

                        // Update Purchase Order Head prime amount & net amount
                        PpPurchaseHead::update_purchase_order_amount($modelPurchaseHead->id);

                        // Set success data
                        \Yii::$app->getSession()->setFlash('success', 'Successfully Inserted');

                        
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $modelPurchaseHead->id]);
                    }
                } catch (\Exception $e) {

                    // Set success data
                    \Yii::$app->getSession()->setFlash('success', $e->getMessage());

                    $transaction->rollBack();
                }
            }
        }


        return $this->render('create', [
            'modelPurchaseHead' => $modelPurchaseHead,
            'modelsPurchaseDetail' => (empty($modelsPurchaseDetail)) ? [new PpPurchaseDetail] : $modelsPurchaseDetail
        ]);

    }
}