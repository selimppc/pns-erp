<?php

namespace backend\controllers;

use Yii;
use backend\models\ImTransferHead;
use backend\models\ImTransferHeadSearch;

use backend\models\ImTransferDetail;
use backend\models\ImTransferDetailSearch;

use backend\models\ImBatchTransfer;
use backend\models\VwImStockView;

use backend\models\Currency;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Model;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

use backend\models\TransactionCode;

use yii\web\Response;


/**
 * ImTransferHeadController implements the CRUD actions for ImTransferHead model.
 */
class StockTransferController extends Controller
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
     * Lists all ImTransferHead models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ImTransferHeadSearch();
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

    /**
     * Creates a new ImTransferHead model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
     public function actionCreate()
    {
        
        // generate purchase Order Number
               
        $transfer_number = TransactionCode::generate_transaction_number('TRN-');
        
        if(empty($transfer_number)){
            $transfer_number = '';
        }
        

        $modelTransferHead = new ImTransferHead;
        $modelsTransferDetail = [new ImTransferDetail];

        // Set Default Data
        $modelTransferHead->transfer_number = $transfer_number; 
        $modelTransferHead->status = 'open'; 

        $modelTransferHead->from_branch_id = 1;
        $modelTransferHead->from_currency_id = 1;

        $modelTransferHead->to_branch_id = 1;
        $modelTransferHead->to_currency_id = 1;

        // Currency Data

        $currency_data = Currency::find()->where(['id' => $modelTransferHead->from_currency_id])->one();

        if(!empty($currency_data)){
            $modelTransferHead->from_exchange_rate = $currency_data->exchange_rate;
            $modelTransferHead->to_exchange_rate = $currency_data->exchange_rate;
        }
        
        if ($modelTransferHead->load(Yii::$app->request->post())) {


            $modelsTransferDetail = Model::createMultiple(ImTransferDetail::classname());
            Model::loadMultiple($modelsTransferDetail, Yii::$app->request->post());

            // validate all models
            $valid = $modelTransferHead->validate();
            $valid = Model::validateMultiple($modelsTransferDetail) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();

                try {
                    $modelTransferHead->status = 'open';

                    if ($flag = $modelTransferHead->save(false)) {

                        foreach ($modelsTransferDetail as $modelTransferDetail) {

                            $modelTransferDetail->im_transfer_head_id = $modelTransferHead->id;
                            if ( ($flag = $modelTransferDetail->save())) {

                                $date = date('Y-m-d');
                                
                                // save im_batch_transfer data
                                $get_stock_view_data = VwImStockView::find()->where(['product_id'=>$modelTransferDetail->product_id])->where(['>=','expire_date',$date])->one();

                                if(!empty($get_stock_view_data)){

                                    $batch_transfer_model = new ImBatchTransfer();

                                    $batch_transfer_model->im_transfer_head_id = $modelTransferHead->id;
                                    $batch_transfer_model->product_id = $modelTransferDetail->product_id;
                                    $batch_transfer_model->batch_number = $get_stock_view_data->batch_number;
                                    $batch_transfer_model->expire_date = $get_stock_view_data->expire_date;
                                    $batch_transfer_model->quantity = $modelTransferDetail->quantity;
                                    $batch_transfer_model->uom = $modelTransferDetail->uom;
                                    $batch_transfer_model->rate = $get_stock_view_data->im_rate;

                                    $valid_batch_transfer = $batch_transfer_model->validate();

                                    if($valid_batch_transfer){
                                        $batch_transfer_model->save();
                                    }else{
                                        print_r($batch_transfer_model->getErrors());
                                        exit();
                                    }


                                }
                                /*$transaction->rollBack();
                                break;*/
                            }else{
                                
                                 exit('else');
                            }
                        }
                    }

                    if ($flag) {

                        // Update transaction code data
                        $update_transaction = TransactionCode::update_transaction_number('TRN-');

                        if($update_transaction){
                            echo 'successfully updated';
                        }else{
                            echo 'successfully not updated';
                        }

                        // Set success data
                        \Yii::$app->getSession()->setFlash('success', 'Successfully Inserted');

                        
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $modelTransferHead->id]);
                    }
                } catch (\Exception $e) {

                    // Set error data
                    \Yii::$app->getSession()->setFlash('error', $e->getMessage());
                    
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('create', [
            'modelTransferHead' => $modelTransferHead,
            'modelsTransferDetail' => (empty($modelsTransferDetail)) ? [new ImTransferDetail] : $modelsTransferDetail
        ]);

    }

    /**
     * Updates an existing ImTransferHead model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $modelTransferHead = $this->findModel($id);
        $modelsTransferDetail = $modelTransferHead->imTransferDetails;

        if ($modelTransferHead->load(Yii::$app->request->post())) {

            $oldIDs = ArrayHelper::map($modelsTransferDetail, 'id', 'id');
            $modelsTransferDetail = Model::createMultiple(ImTransferDetail::classname(), $modelsTransferDetail);
            Model::loadMultiple($modelsTransferDetail, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsTransferDetail, 'id', 'id')));

            // validate all models
            $valid = $modelTransferHead->validate();
            $valid = Model::validateMultiple($modelsTransferDetail) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $modelTransferHead->save(false)) {
                        if (!empty($deletedIDs)) {
                            ImTransferDetail::deleteAll(['id' => $deletedIDs]);
                        }
                        foreach ($modelsTransferDetail as $modelTransferDetail) {
                            $modelTransferDetail->im_transfer_head_id = $modelTransferHead->id;

                         /*   $product_id_explode = explode(':::', $modelTransferDetail->product_id);

                            $modelTransferDetail->product_id = $product_id_explode['0'];*/

                            if (! ($flag = $modelTransferDetail->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();

                        // Set success data
                        \Yii::$app->getSession()->setFlash('success', 'Successfully Updated');

                        return $this->redirect(['view', 'id' => $modelTransferHead->id]);
                    }
                } catch (\Exception $e) {

                    // Set error data
                    \Yii::$app->getSession()->setFlash('error', $e->getMessage());

                    $transaction->rollBack();
                }
            }
        }

        return $this->render('update', [
            'modelTransferHead' => $modelTransferHead,
            'modelsTransferDetail' => (empty($modelsTransferDetail)) ? [new ImTransferDetail] : $modelsTransferDetail
        ]);
    }

    /**
     * Deletes an existing ImTransferHead model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
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

    public function actionConfirmDispatch($id)
    {
        $model = $this->findModel($id);

        if($model){

            $transaction = \Yii::$app->db->beginTransaction();

            try {

                $result = \Yii::$app->db->createCommand("CALL sp_im_trn_dispatch(:p_id, :p_userId)") 
                      ->bindValue(':p_id' , $id )
                      ->bindValue(':p_userId', Yii::$app->user->id)
                      ->execute(); 

                // Set success data
                \Yii::$app->getSession()->setFlash('success', 'Successfully Dispatch');

                $transaction->commit();

            } catch (\Exception $e) {
                \Yii::$app->getSession()->setFlash('error', $e->getMessage());

               $transaction->rollBack();
            }
           
        }

        return $this->redirect(['index']);
    }


    public function actionFindProduct(){
        if (Yii::$app->request->isAjax) {

            Yii::$app->response->format = Response::FORMAT_JSON;
            $session = Yii::$app->session;
            $response = [];

            /*$product_data = explode(':::', $_POST['product_id']);*/

            $date = date('Y-m-d');

            $product_data_avaliable = VwImStockView::find()->where(['product_id' => $_POST['product_id']])->andWhere(['branch_id' => $_POST['branch_id']])->andWhere(['>=','expire_date',$date])->all();

            $total_avaliable = 0;
            if(!empty($product_data_avaliable)){
               
                foreach($product_data_avaliable as $avaliable_data){
           //         echo $avaliable_data->batch_number.' 1 ';
                    $total_avaliable = $total_avaliable + $avaliable_data->available;
                }
            }

            $product_data = VwImStockView::find()->where(['product_id' => $_POST['product_id']])->andWhere(['branch_id' => $_POST['branch_id']])->andWhere(['>=','expire_date',$date])->one();

            if(!empty($product_data)){
                $response['available_quantity'] = $total_avaliable;
                $response['batch_number'] = $product_data->batch_number;
                $response['expire_date'] = $product_data->expire_date;
                $response['rate'] = $product_data->im_rate;
                $response['sell_rate'] = $product_data->sell_rate;
                $response['batch_number'] = $product_data->batch_number;
                $response['uom'] = isset($product_data->productUom)?$product_data->productUom->title:'';
                $response['uom_id'] = $product_data->uom;
                $response['view_popup'] = Url::toRoute(['/product/view-popup','id'=> $product_data->product_id]);
                $response['result'] = 'success';
            }else{
                $response['result'] = 'error';
            }

            return $response;

        }
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