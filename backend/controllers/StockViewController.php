<?php

namespace backend\controllers;

use Yii;
use backend\models\ImGrnDetail;

use backend\models\ImGrnHead;
use backend\models\ImGrnDetailSearch;

use backend\models\VwImStockView;
use backend\models\VwImStockViewSearch;

use backend\models\PpPurchaseHead;

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

        $data = VwImStockView::get_stock_data();

        $models = VwImStockView::find()->all();

        $searchModel = new VwImStockViewSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize=30;


        // Dhaka branch quantity
        $dhaka_branch_qty = VwImStockView::total_qty_branch(1);    

        // Savar branch quantity
        $savar_branch_qty = VwImStockView::total_qty_branch(2);    

        // PO approved qty
        $po_approved_qty = PpPurchaseHead::total_po_qty('approved');
        
        return $this->render('index', [
            'models' => $models,
            'dhaka_branch_qty' => $dhaka_branch_qty,
            'savar_branch_qty' => $savar_branch_qty,
            'po_approved_qty' => $po_approved_qty,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'data' => $data
        ]);

    }

    public function actionAll()
    {

        if(isset($_GET['branch']) && !empty($_GET['branch'])){

          if($_GET['branch'] == 'dhaka')
          {
            $data = VwImStockView::get_stock_data(1);
            // Dhaka branch quantity
            $total_qty = VwImStockView::total_qty_branch(1);     
          }

          if($_GET['branch'] == 'savar')
          {
            $data = VwImStockView::get_stock_data(2);
            // Dhaka branch quantity
            $total_qty = VwImStockView::total_qty_branch(2);     
          }

          $pageTitle = 'Present stock of '. ucfirst($_GET['branch']) .' :: '. $total_qty;

        }else{

          $data = VwImStockView::get_stock_data();

          // Dhaka branch quantity
          $dhaka_branch_qty = VwImStockView::total_qty_branch(1);    

          // Savar branch quantity
          $savar_branch_qty = VwImStockView::total_qty_branch(2); 

          $pageTitle = 'Total Present Stock :: '. ($dhaka_branch_qty + $savar_branch_qty);

        }
        
        return $this->render('all', [
            'data' => $data,
            'pageTitle' => $pageTitle
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

           $product_data = VwImStockView::find()->where(['branch_id' => $_POST['branch_id']])->andWhere(['>=','expire_date',$date])->groupBy('product_id')->all();

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



   public function actionUpcomingStock()
   {
      $data = 'upcoming stock';

      return $this->render('upcoming_stock',[
          'data' => $data
        ]);

   }


   public function actionNewPi()
   {

      $data = 'new pi';

      return $this->render('upcoming_stock',[
          'data' => $data
        ]);

   }

}