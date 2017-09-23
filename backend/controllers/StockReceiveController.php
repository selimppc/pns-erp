<?php

namespace backend\controllers;

use Yii;
use backend\models\ImTransferHead;
use backend\models\ImTransferHeadSearch;

use backend\models\ImTransferDetail;
use backend\models\ImTransferDetailSearch;

use backend\models\ImBatchTransfer;
use backend\models\VwImStockView;

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

            try {

                $result = \Yii::$app->db->createCommand("CALL sp_im_trn_receive(:p_id, :p_userId)") 
                      ->bindValue(':p_id' , $id )
                      ->bindValue(':p_userId', Yii::$app->user->id)
                      ->execute(); 

                // Set success data
                \Yii::$app->getSession()->setFlash('success', 'Successfully Received');

               // $transaction->commit();

            } catch (\Exception $e) {
                \Yii::$app->getSession()->setFlash($e->getMessage());
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