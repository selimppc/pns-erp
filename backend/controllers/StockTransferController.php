<?php

namespace backend\controllers;

use Yii;
use backend\models\ImTransferHead;
use backend\models\ImTransferHeadSearch;

use backend\models\ImTransferDetail;
use backend\models\ImTransferDetailSearch;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Model;
use yii\helpers\ArrayHelper;

use backend\models\TransactionCode;


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
               
        $transfer_number = TransactionCode::generate_transaction_number('TRNF');
        
        if(empty($transfer_number)){
            $transfer_number = '';
        }
        

        $modelTransferHead = new ImTransferHead;
        $modelsTransferDetail = [new ImTransferDetail];

        $modelTransferHead->transfer_number = $transfer_number; 
        $modelTransferHead->status = 'open'; 
        
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
                            if (! ($flag = $modelTransferDetail->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }

                    if ($flag) {

                        // Update transaction code data
                        $update_transaction = TransactionCode::update_transaction_number('TRNF');

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

            $model->status = 'dispatch';

            $valid = $model->validate();
            if($valid){

                // Set success data
                \Yii::$app->getSession()->setFlash('success', 'Successfully Dispatch');

                $model->save();    
            }else{
                print_r($model->getErrors());
                exit();
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
