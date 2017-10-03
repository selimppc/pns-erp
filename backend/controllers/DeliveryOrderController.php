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
        $searchModel = new SmHeadSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,'confirmed');
        $dataProvider->pagination->pageSize=30;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
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

            $model->status = 'delivered';

            $valid = $model->validate();
            if($valid){

                // Set success data
                \Yii::$app->getSession()->setFlash('success', 'Successfully Delivered');

                $model->save();    
            }else{
                print_r($model->getErrors());
                exit();
            }
            

           
        }

        return $this->redirect(['index']);
    }

}