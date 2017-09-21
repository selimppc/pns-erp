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


/**
 * PpPurchaseHeadController implements the CRUD actions for PpPurchaseHead model.
 */
class PurchaseOrderController extends Controller
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
     * Lists all PpPurchaseHead models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PpPurchaseHeadSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize=30;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PpPurchaseHead model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        if(!empty($model)){

            $purchased_order_details = PpPurchaseDetail::find()->where(['pp_purchase_head_id' => $id])->all();


            return $this->render('view', [
                'model' => $model,
                'purchased_order_details' => $purchased_order_details
            ]);

        }else{
            return $this->redirect(['index']);
        }
        
    }


    public function actionViewPopup($id){

        $model = PpPurchaseHead::find()->where(['id' => $id])->one();

        $purchased_order_details = PpPurchaseDetail::find()->where(['pp_purchase_head_id' => $model->id])->all();
        
        return Yii::$app->controller->renderPartial('purchase-order-modal',[
                'model' => $model,
                'purchased_order_details' => $purchased_order_details
            ]);
    }

    /**
     * Creates a new PpPurchaseHead model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        /*$model = new PpPurchaseHead();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }*/

        // generate purchase Order Number
               
        $po_order_number = TransactionCode::generate_transaction_number('PO--');
        
        if(empty($po_order_number)){
            $po_order_number = '';
        }
        

        $modelPurchaseHead = new PpPurchaseHead;
        $modelsPurchaseDetail = [new PpPurchaseDetail];

        $modelPurchaseHead->po_order_number = $po_order_number; 
        $modelPurchaseHead->status = 'open'; 
        $modelPurchaseHead->tax_rate ='0.00';
        $modelPurchaseHead->tax_amount ='0.00';
        $modelPurchaseHead->discount_rate ='0.00';
        $modelPurchaseHead->discount_amount ='0.00';
        $modelPurchaseHead->prime_amount ='0.00';
        $modelPurchaseHead->net_amount ='0.00';

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
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('create', [
            'modelPurchaseHead' => $modelPurchaseHead,
            'modelsPurchaseDetail' => (empty($modelsPurchaseDetail)) ? [new PpPurchaseDetail] : $modelsPurchaseDetail
        ]);

    }

    /**
     * Updates an existing PpPurchaseHead model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
       
        $modelPurchaseHead = $this->findModel($id);
        $modelsPurchaseDetail = $modelPurchaseHead->ppPurchaseDetails;

        if ($modelPurchaseHead->load(Yii::$app->request->post())) {

            $oldIDs = ArrayHelper::map($modelsPurchaseDetail, 'id', 'id');
            $modelsPurchaseDetail = Model::createMultiple(PpPurchaseDetail::classname(), $modelsPurchaseDetail);
            Model::loadMultiple($modelsPurchaseDetail, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsPurchaseDetail, 'id', 'id')));

            // validate all models
            $valid = $modelPurchaseHead->validate();
            $valid = Model::validateMultiple($modelsPurchaseDetail) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $modelPurchaseHead->save(false)) {
                        if (!empty($deletedIDs)) {
                            PpPurchaseDetail::deleteAll(['id' => $deletedIDs]);
                        }
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
                        $transaction->commit();

                        // Update Purchase Order Head prime amount & net amount
                        PpPurchaseHead::update_purchase_order_amount($modelPurchaseHead->id);

                        // Set success data
                        \Yii::$app->getSession()->setFlash('success', 'Successfully Updated');

                        return $this->redirect(['view', 'id' => $modelPurchaseHead->id]);
                    }
                } catch (\Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('update', [
            'modelPurchaseHead' => $modelPurchaseHead,
            'modelsPurchaseDetail' => (empty($modelsPurchaseDetail)) ? [new PpPurchaseDetail] : $modelsPurchaseDetail
        ]);

    }

    /**
     * Deletes an existing PpPurchaseHead model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if($model){

            $transaction_details = PpPurchaseDetail::deleteAll(['pp_purchase_head_id' => $id]);

            if($transaction_details){
                $model->delete();
            }

        }

        return $this->redirect(['index']);
    }

    public function actionApproved($id)
    {
        $model = $this->findModel($id);

        if($model){

            $model->status = 'approved';

            $valid = $model->validate();
            if($valid){

                // Set success data
                \Yii::$app->getSession()->setFlash('success', 'Successfully Approved');

                $model->save();    
            }else{
                print_r($model->getErrors());
                exit();
            }
            

           
        }

        return $this->redirect(['index']);
    }


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
     * Finds the PpPurchaseHead model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PpPurchaseHead the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PpPurchaseHead::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
