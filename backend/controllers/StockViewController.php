<?php

namespace backend\controllers;

use Yii;
use backend\models\ImGrnDetail;

use backend\models\ImGrnHead;
use backend\models\ImGrnDetailSearch;

use backend\models\VwImStockView;
use backend\models\VwImStockViewSearch;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\web\Response;


class StockViewController extends Controller{


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

        $models = VwImStockView::find()->all();

        $searchModel = new VwImStockViewSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize=30;

        return $this->render('index', [
            'models' => $models,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }


    public function actionFindProduct()
   {
       if (Yii::$app->request->isAjax)
       {
           Yii::$app->response->format = Response::FORMAT_JSON;
           $session = Yii::$app->session;
           $response = [];


           $date = date('Y-m-d');

           $product_data = VwImStockView::find()->where(['branch_id' => $_POST['branch_id']])->andWhere(['>=','expire_date',$date])->all();

           $select = '<option>--Select Product--</option>';

           if(!empty($product_data))
           {
               foreach($product_data as $product)
               {
                   $select.='<option value='.$product->product_id.'>'.$product->product_title .' :: '.$product->product_code. ' :: '.$product->product->model .'</option>';
               }
           }

           $response['content'] = $select;

           return $response;
       }
   }

}