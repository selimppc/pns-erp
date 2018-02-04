<?php

namespace backend\controllers;

use Yii;
use backend\models\ImTransferHead;
use backend\models\ImTransferHeadSearch;

use backend\models\ImTransferDetail;
use backend\models\ImTransferDetailSearch;

use backend\models\ImBatchTransfer;
use backend\models\VwImStockView;

use backend\models\ImTransaction;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Model;
use yii\helpers\ArrayHelper;

use backend\models\TransactionCode;


class StockReceiveController extends Controller{

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
     * Lists all ImTransferHead models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ImTransferHeadSearch();

        #$searchModel->status = 'dispatch';
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize=30;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single ImTransferHead model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        if(!empty($model)){

            $transfer_details = ImTransferDetail::find()->where(['im_transfer_head_id'=>$model->id])->all();

            return $this->render('view', [
                'model' => $model,
                'transfer_details' => $transfer_details
            ]);

        }

        
    }


    public function actionConfirmReceive($id)
    {
        $model = $this->findModel($id);

        if($model){

            $transaction = \Yii::$app->db->beginTransaction();

            try {


            $connection = Yii::$app->getDb();
            $command = $connection->createCommand("
                SELECT a.`id`, b.`transfer_number`, b.`from_branch_id`, b.`to_branch_id`, a.`product_id`, a.`batch_number`, a.`expire_date`, a.`rate`, a.`quantity`, 
                  a.`uom`,  b.`from_currency_id`, b.`from_exchange_rate`
                  FROM `im_batch_transfer` a 
                  INNER JOIN `im_transfer_head` b 
                  ON a.`im_transfer_head_id`=b.`id`
                  WHERE b.`id`='$id' AND b.`status`='dispatch'");

            $result = $command->queryAll();

            if(count($result) > 0)
            {

              foreach($result as $value)
              {


                  $im_transfer_model = new ImTransaction;

                  $im_transfer_model->transaction_number = 'ooo';
                  $im_transfer_model->product_id = $value['product_id'];
                  $im_transfer_model->branch_id = $value['to_branch_id'];
                  $im_transfer_model->batch_number = $value['batch_number'];
                  $im_transfer_model->date = date('Y-m-d');
                  $im_transfer_model->expire_date = $value['expire_date'];
                  $im_transfer_model->quantity = $value['quantity'];
                  $im_transfer_model->sign = 1;
                  $im_transfer_model->uom = $value['uom'];
                  $im_transfer_model->rate = $value['rate'];
                  $im_transfer_model->total_price = $value['quantity'] * $value['rate'];
                  $im_transfer_model->base_value = $value['quantity'] * $value['rate'];
                  $im_transfer_model->reference_number = $value['transfer_number'];
                  $im_transfer_model->reference_row = $value['id'];
                  $im_transfer_model->note = $value['to_branch_id'];
                  $im_transfer_model->status = 'open';
                  $im_transfer_model->currency_id = $value['from_currency_id'];
                  $im_transfer_model->exchange_rate = $value['from_exchange_rate'];
                  $im_transfer_model->created_at = date('Y-m-d');
                  $im_transfer_model->created_by = Yii::$app->user->id;
                  $im_transfer_model->foreign_rate = $value['rate'];




                  $valid = $im_transfer_model->validate();

                  if($valid)
                  {

                    if($im_transfer_model->save())
                    {
                      echo 'ok';
                    }else{
                      echo 'not ok';
                    }

                  }else{
                    print_r($im_transfer_model->getErrors());
                    exit();
                  }

                  
              }


        $connection->createCommand()
        ->update('im_transfer_head', ['status' => 'received'], 'id ='.$id)
        ->execute();

            }




                // $result = \Yii::$app->db->createCommand("CALL sp_im_trn_receive(:p_id, :p_userId)") 
                //       ->bindValue(':p_id' , $id )
                //       ->bindValue(':p_userId', Yii::$app->user->id)
                //       ->execute(); 

                // Set success data
                \Yii::$app->getSession()->setFlash('success', 'Successfully Received');

                $transaction->commit();

            } catch (\Exception $e) {
                \Yii::$app->getSession()->setFlash('error', $e->getMessage());
                $transaction->rollBack();
            }
            

           
        }

        return $this->redirect(['index']);
    }



    /**
     * Finds the ImTransferHead model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ImTransferHead the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ImTransferHead::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


}