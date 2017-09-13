<?php

namespace backend\controllers;

use Yii;
use backend\models\ImAdjustHead;
use backend\models\ImAdjustHeadSearch;

use backend\models\ImAdjustDetail;

use backend\models\TransactionCode;
use backend\models\Model;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * StockAdustmentController implements the CRUD actions for ImAdjustHead model.
 */
class StockAdustmentController extends Controller
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
     * Lists all ImAdjustHead models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ImAdjustHeadSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ImAdjustHead model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        if(!empty($model)){

            $adjustment_details = ImAdjustDetail::find()->where(['im_adjust_head_id'=> $model->id])->all();

            return $this->render('view', [
                'model' => $model,
                'adjustment_details' => $adjustment_details
            ]);    
        }
        
    }

    /**
     * Creates a new ImAdjustHead model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
     /**
     * Creates a new ImTransferHead model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
     public function actionCreate()
    {
        
        // generate purchase Order Number
               
        $adjustment_number = TransactionCode::generate_transaction_number('AD--');
        
        if(empty($adjustment_number)){
            $adjustment_number = '';
        }
        

        $modelAdjustmentHead = new ImAdjustHead;
        $modelsAdjustmentDetail = [new ImAdjustDetail];

        $modelAdjustmentHead->transaction_no = $adjustment_number; 
        $modelAdjustmentHead->status = 'open'; 
        
        if ($modelAdjustmentHead->load(Yii::$app->request->post())) {

            $modelsAdjustmentDetail = Model::createMultiple(ImAdjustDetail::classname());
            Model::loadMultiple($modelsAdjustmentDetail, Yii::$app->request->post());

            // validate all models
            $valid = $modelAdjustmentHead->validate();
            $valid = Model::validateMultiple($modelsAdjustmentDetail) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();

                try {
                    $modelAdjustmentHead->status = 'open';
                    if ($flag = $modelAdjustmentHead->save(false)) {
                        foreach ($modelsAdjustmentDetail as $modelAdjustmentDetail) {
                            $modelAdjustmentDetail->im_adjust_head_id = $modelAdjustmentHead->id;
                            if (! ($flag = $modelAdjustmentDetail->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }

                    if ($flag) {

                        // Update transaction code data
                        $update_transaction = TransactionCode::update_transaction_number('AD--');

                        if($update_transaction){
                            echo 'successfully updated';
                        }else{
                            echo 'successfully not updated';
                        }

                        // Set success data
                        \Yii::$app->getSession()->setFlash('success', 'Successfully Inserted');

                        
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $modelAdjustmentHead->id]);
                    }
                } catch (\Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('create', [
            'modelAdjustmentHead' => $modelAdjustmentHead,
            'modelsAdjustmentDetail' => (empty($modelsAdjustmentDetail)) ? [new ImAdjustDetail] : $modelsAdjustmentDetail
        ]);

    }

    /**
     * Updates an existing ImAdjustHead model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $modelAdjustmentHead = $this->findModel($id);
        $modelsAdjustmentDetail = $modelAdjustmentHead->imAdjustDetails;

        if ($modelAdjustmentHead->load(Yii::$app->request->post())) {

            $oldIDs = ArrayHelper::map($modelsAdjustmentDetail, 'id', 'id');
            $modelsAdjustmentDetail = Model::createMultiple(ImAdjustDetail::classname(), $modelsAdjustmentDetail);
            Model::loadMultiple($modelsAdjustmentDetail, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsAdjustmentDetail, 'id', 'id')));

            // validate all models
            $valid = $modelAdjustmentHead->validate();
            $valid = Model::validateMultiple($modelsAdjustmentDetail) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $modelAdjustmentHead->save(false)) {
                        if (!empty($deletedIDs)) {
                            ImAdjustDetail::deleteAll(['id' => $deletedIDs]);
                        }
                        foreach ($modelsAdjustmentDetail as $modelAdjustmentDetail) {
                            $modelAdjustmentDetail->im_adjust_head_id = $modelAdjustmentHead->id;
                            if (! ($flag = $modelAdjustmentDetail->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();

                        // Set success data
                        \Yii::$app->getSession()->setFlash('success', 'Successfully Updated');

                        return $this->redirect(['view', 'id' => $modelAdjustmentHead->id]);
                    }
                } catch (\Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('update', [
            'modelAdjustmentHead' => $modelAdjustmentHead,
            'modelsAdjustmentDetail' => (empty($modelsAdjustmentDetail)) ? [new ImAdjustDetail] : $modelsAdjustmentDetail
        ]);
    }

    /**
     * Deletes an existing ImAdjustHead model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    public function actionConfirmAdjustment($id)
    {
        $model = $this->findModel($id);

        if($model){

            $model->status = 'confirm';

            $valid = $model->validate();
            if($valid){

                // Set success data
                \Yii::$app->getSession()->setFlash('success', 'Successfully Confirmed');

                $model->save();    
            }else{
                print_r($model->getErrors());
                exit();
            }
            

           
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the ImAdjustHead model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ImAdjustHead the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ImAdjustHead::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
