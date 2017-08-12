<?php

namespace backend\controllers;

use Yii;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\ProductMaster;
use backend\models\BranchMaster;
use backend\models\CustomerMaster;
use backend\models\Chartofaccounts;
use backend\models\Transaction;

/**
 * ReportController implements the CRUD actions for ProductMaster model.
 */
class ReportController extends Controller
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


    public function actionProductList(){

    	$model = new ProductMaster();

    	return $this->render('product_list',[
    			'model' => $model
    		]);
    }


    public function actionCustomerLedgerReport(){

    	$model = new CustomerMaster();

    	return $this->render('customer_list',[
    			'model' => $model
    		]);

    }

    public function actionConsolidatedTrialBalance(){

    	$model = new BranchMaster();

    	return $this->render('consolidated_trial_balance',[
    			'model' => $model
    		]);

    }

    public function actionTrialBalanceAll(){
    	
    	$model = new BranchMaster();

    	return $this->render('consolidated_trial_balance',[
    			'model' => $model
    		]);

    }

    public function actionChartOfAccountList(){

    	$model = new Chartofaccounts();

    	return $this->render('chart_of_account_list',[
    			'model' => $model
    		]);

    }

    public function actionJournalTransaction(){

    	$model = new Transaction();

    	return $this->render('transaction',[
    			'model' => $model
    		]);

    }

}