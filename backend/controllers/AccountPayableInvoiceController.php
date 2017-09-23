<?php


namespace backend\controllers;

use Yii;
use backend\models\AmCoa;
use backend\models\AmCoaSearch;
use backend\models\TransactionCode;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use backend\models\ImGrnHead;
use backend\models\ImGrnHeadSearch;

use backend\models\ImGrnDetail;
use backend\models\ImGrnDetailSearch;


class AccountPayableInvoiceController extends Controller{


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

    	$searchModel = new ImGrnHeadSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,'open');
        $dataProvider->pagination->pageSize=30;


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }

}