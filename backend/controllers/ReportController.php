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
use backend\models\PurchaseMaster;

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

    	$title = 'Consolidated Trial Balance';

    	return $this->render('consolidated_trial_balance',[
    			'model' => $model,
    			'title' => $title
    		]);

    }

    public function actionTrialBalanceAll(){
    	
    	$model = new BranchMaster();

    	$title = 'Trial Balance';

    	return $this->render('consolidated_trial_balance',[
    			'model' => $model,
    			'title' => $title
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

    public function actionBalanceSheet(){

    	$model = new BranchMaster();

    	$title = 'Balance Sheet';

    	return $this->render('balance_sheet',[
    			'model' => $model,
    			'title' => $title
    		]);

    }

    public function actionProfitLoss(){

    	$model = new BranchMaster();

    	$title = 'Profit & Loss';

    	return $this->render('balance_sheet',[
    			'model' => $model,
    			'title' => $title
    		]);

    }

    public function actionPurchaseOrderReport(){

		$model = new PurchaseMaster();

    	$title = 'Purchase Order Report';

    	return $this->render('purchase_order',[
    			'model' => $model,
    			'title' => $title
    		]);

    }

    public function actionItemLedger(){

    	$model = new BranchMaster();

    	$title = 'Item Ledger';

    	return $this->render('consolidated_trial_balance',[
    			'model' => $model,
    			'title' => $title
    		]);

    }

    public function actionInventoryMovement(){

    	$model = new BranchMaster();

    	$title = 'Inventory Movement';

    	return $this->render('inventory_movement',[
    			'model' => $model,
    			'title' => $title
    		]);

    }

    public function actionStockDispatch(){

    	$model = new BranchMaster();

    	$title = 'Stock Dispatch';

    	return $this->render('consolidated_trial_balance',[
    			'model' => $model,
    			'title' => $title
    		]);

    }

    public function actionStockBalance(){

    	$model = new BranchMaster();

    	$title = 'Stock Balance';

    	return $this->render('stock_balance',[
    			'model' => $model,
    			'title' => $title
    		]);

    }

    public function actionStockBalanceAfterAdjustment(){

    	$model = new BranchMaster();

    	$title = 'Stock Balance After Adjustment';

    	return $this->render('stock_balance',[
    			'model' => $model,
    			'title' => $title
    		]);

    }

}