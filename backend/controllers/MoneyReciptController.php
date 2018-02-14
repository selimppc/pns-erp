<?php


namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use backend\models\VwSmCustomerReceivable;
use backend\models\VwSmCustomerReceivableSearch;


class MoneyReciptController extends Controller{


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

        $searchModel = new VwSmCustomerReceivableSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider->pagination->pageSize=30;


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }

    public function actionCreateMoneyReceipt($sm_head_id='',$customer_id ='', $branch_id='')
    {
        echo $sm_head_id . ' == '.$customer_id .' == '.$branch_id ;
    }

}