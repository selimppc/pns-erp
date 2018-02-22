<?php


namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use backend\models\VwSmCustomerReceivable;
use backend\models\VwSmCustomerReceivableSearch;
use backend\models\TransactionCode;
use backend\models\SmHead;


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

        // Generate Transaction Code
        $receipt_number = TransactionCode::generate_transaction_number('MR--');

        $data = VwSmCustomerReceivable::find()->where(['sm_head_id' => $sm_head_id])->andWhere(['customer_id' => $customer_id])->one();

        if(!empty($data))
        {
            $model = new SmHead();
            $model->sm_number = $receipt_number;
            $model->date = Date('Y-m-d');
            $model->customer_id = $data->customer_id;
            $model->money_receipt_customer_name = $data->customer_name;
            $model->status = 'open';
            $model->branch_id = $data->branch_id;
            $model->money_receipt_branch = isset($data->branch)?$data->branch->title:'';
            // Save data
            if ($model->load(Yii::$app->request->post()))
            {

            }

            return $this->render('create_money_receipt',[
                'model' => $model,
                'data' => $data
            ]);

        }

    }

}