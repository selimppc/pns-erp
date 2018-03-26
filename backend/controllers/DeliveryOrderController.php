<?php

namespace backend\controllers;

use Yii;
use backend\models\SmHead;
use backend\models\SmHeadSearch;

use backend\models\SmDetail;
use backend\models\SmDetailSearch;

use backend\models\TransactionCode;
use backend\models\Currency;

use yii\web\Controller;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Model;


class DeliveryOrderController extends Controller{


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

        // Calculate todays & current month sales
        $current_date = Date('Y-m-d');
        
        $start_date = date('Y-m-01',strtotime('this month'));
        $end_date = date('Y-m-t',strtotime('this month'));

        $todays_delivered = SmHead::total_delievered_qty($current_date,'','delivered') ;
        $this_month_delivered = SmHead::total_delievered_qty($start_date,$end_date,'delivered') ;
        $pending_delivered = SmHead::total_delievered_qty('','','confirmed') ;


        $searchModel = new SmHeadSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,'confirmed');
        $dataProvider->pagination->pageSize=30;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'todays_delivered' => $todays_delivered,
            'this_month_delivered' => $this_month_delivered,
            'pending_delivered' => $pending_delivered
        ]);
    }

    /**
     * @param $id
     * @return \yii\web\Response
     */
    public function actionDelivery($id)
    {
        $model = SmHead::find()->where(['id' => $id])->one();

        if($model){

            $transaction = \Yii::$app->db->beginTransaction();

            try {

                $result = \Yii::$app->db->createCommand("CALL sp_sm_order_delivered(:p_sm_head_id, :p_userId)") 
                      ->bindValue(':p_sm_head_id' , $id )
                      ->bindValue(':p_userId', Yii::$app->user->id)
                      ->execute(); 

                // Set success data
                \Yii::$app->getSession()->setFlash('success', 'Successfully Delivered');

                $transaction->commit();

            } catch (\Exception $e) {

                \Yii::$app->getSession()->setFlash('error', $e->getMessage());
                
                $transaction->rollBack();
            }

           
        }

        return $this->redirect(['index']);
    }

}