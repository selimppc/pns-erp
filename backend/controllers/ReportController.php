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
use backend\models\SmHead;
USE backend\models\VwSmMrReceive;

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


    public function actionDaily()
    {

        if(isset($_GET['date']) && !empty($_GET['date']))
        {
            $current_date = $_GET['date'];

            $label = "Sales of ".date('dS F Y');
        }else{
            $current_date = Date('Y-m-d');

            $label = "Today's sales of ".date('F');    
        }
        

        $daily_report = SmHead::daily_report($current_date);

        $title = 'Daily Report';

        
        
        return $this->render('daily_report',[
                'data' => $daily_report,
                'title' => $title,
                'label' => $label
            ]);
    }


    public function actionTodaysCollection()
    {

        if(isset($_GET['date']) && !empty($_GET['date']))
        {
            $current_date = $_GET['date'];

            $label = "Sales collection of ".date('dS F Y');
        }else{
            $current_date = Date('Y-m-d');

            $label = "Today's sales collection of ".date('F');    
        }
        
        $collection_report = SmHead::collection_report($current_date);

        $title = 'Sales collection report';
        
        return $this->render('collection_report',[
                'data' => $collection_report,
                'title' => $title,
                'label' => $label
            ]);
    }


    public function actionCollectionReport()
    {
        $current_date = Date('Y-m-d');

        if(isset($_POST['monthly-wise']) && !empty($_POST['from_date']) && !empty($_POST['to_date']))
        {
            $start_date = $_POST['from_date'];
            $end_date = $_POST['to_date'];

            $label = "Sales collection Report of ".date('jS M Y',strtotime($start_date)). ' to '.date('jS M Y',strtotime($end_date));
        }
        elseif (isset($_GET['first-date']) && isset($_GET['last-date'])) {
            
            $start_date = $_GET['first-date'];
            $end_date = $_GET['last-date'];   

            $label = "Sales collection Report of ".date('F Y', strtotime($start_date));
 
        }
        else{
            $start_date = date('Y-m-01',strtotime('this month'));
            $end_date = date('Y-m-t',strtotime('this month'));   

            $label = "Sales collection Report of ".date('F'); 
        }
            
        $collection_report = SmHead::collection_report($start_date,$end_date);

        $title = 'Sales collection report';

        return $this->render('collection_report',[
                'data' => $collection_report,
                'title' => $title,
                'label' => $label
            ]);
    }


    public function actionLast15Days()
    {

        $title = 'Last 15 days report';

        return $this->render('last_15_days',[
                'title' => $title
            ]);
    }

    public function actionLastMonthOfCurrentYear()
    {

        $title = 'Last Month Of Current Year report';

        if(isset($_GET['type']) && $_GET['type'] == 'collection')
        {

            return $this->render('last_month_of_current_year_collection',[
                    'title' => $title
                ]);

        }else{

            return $this->render('last_month_of_current_year',[
                    'title' => $title
                ]);

        }

        
    }

    public function actionLast15DaysCollection()
    {

        $title = 'Last 15 days collection report';

        return $this->render('last_15_days_collection',[
                'title' => $title
            ]);
    }

    public function actionMonthly()
    {

        $current_date = Date('Y-m-d');

        if(isset($_POST['monthly-wise']) && !empty($_POST['from_date']) && !empty($_POST['to_date']))
        {
            $start_date = $_POST['from_date'];
            $end_date = $_POST['to_date'];

            $label = "Sales Report of ".date('jS M Y',strtotime($start_date)). ' to '.date('jS M Y',strtotime($end_date));
        }elseif (isset($_GET['first-date']) && isset($_GET['last-date'])) {
            
            $start_date = $_GET['first-date'];
            $end_date = $_GET['last-date'];   

            $label = "Sales Report of ".date('F Y', strtotime($start_date));

        }
        else{
            $start_date = date('Y-m-01',strtotime('this month'));
            $end_date = date('Y-m-t',strtotime('this month'));   

            $label = "Sales Report of ".date('F'); 
        }

        $daily_report = SmHead::daily_report($start_date,$end_date);

        $title = 'Monthly Report';

        
        
        return $this->render('daily_report',[
                'data' => $daily_report,
                'title' => $title,
                'label' => $label
            ]);
    }

    public function actionProductList(){

        if(isset(\Yii::$app->params['report_product_list']) && !empty(\Yii::$app->params['report_product_list'])){
                    $report_help_text = \Yii::$app->params['report_product_list'];
        }else{
            $report_help_text = '';
        }

    	$model = new ProductMaster();

    	return $this->render('product_list',[
    			'model' => $model,
                'report_help_text' => $report_help_text
    		]);
    }


    public function actionCustomerLedgerReport(){

        if(isset(\Yii::$app->params['report_customer_ledger_report']) && !empty(\Yii::$app->params['report_customer_ledger_report'])){
                    $report_help_text = \Yii::$app->params['report_customer_ledger_report'];
        }else{
            $report_help_text = '';
        }

    	$model = new CustomerMaster();

    	return $this->render('customer_list',[
    			'model' => $model,
                'report_help_text' => $report_help_text
    		]);

    }

    public function actionConsolidatedTrialBalance(){

        if(isset(\Yii::$app->params['consolidated_trial_balance']) && !empty(\Yii::$app->params['consolidated_trial_balance'])){
                    $report_help_text = \Yii::$app->params['consolidated_trial_balance'];
        }else{
            $report_help_text = '';
        }

    	$model = new BranchMaster();

    	$title = 'Consolidated Trial Balance';

    	return $this->render('consolidated_trial_balance',[
    			'model' => $model,
    			'title' => $title,
                'report_help_text' => $report_help_text
    		]);

    }

    public function actionTrialBalanceAll(){

        if(isset(\Yii::$app->params['trial_balance_all']) && !empty(\Yii::$app->params['trial_balance_all'])){
                    $report_help_text = \Yii::$app->params['trial_balance_all'];
        }else{
            $report_help_text = '';
        }
    	
    	$model = new BranchMaster();

    	$title = 'Trial Balance';

    	return $this->render('consolidated_trial_balance',[
    			'model' => $model,
    			'title' => $title,
                'report_help_text' => $report_help_text
    		]);

    }

    public function actionChartOfAccountList(){

        if(isset(\Yii::$app->params['report_chart_of_account_list']) && !empty(\Yii::$app->params['report_chart_of_account_list'])){
                    $report_help_text = \Yii::$app->params['report_chart_of_account_list'];
        }else{
            $report_help_text = '';
        }

    	$model = new Chartofaccounts();

    	return $this->render('chart_of_account_list',[
    			'model' => $model,
                'report_help_text' => $report_help_text
    		]);

    }


    public function actionTotalDue()
    {

        $total_due = VwSmMrReceive::total_due_list();
        
        return $this->render('total_due',[
                'total_due' => $total_due
            ]);
    }

    public function actionJournalTransaction(){

        if(isset(\Yii::$app->params['report_journal_transaction']) && !empty(\Yii::$app->params['report_journal_transaction'])){
                    $report_help_text = \Yii::$app->params['report_journal_transaction'];
        }else{
            $report_help_text = '';
        }

    	$model = new Transaction();

    	return $this->render('transaction',[
    			'model' => $model,
                'report_help_text' => $report_help_text
    		]);

    }

    public function actionBalanceSheet(){

        if(isset(\Yii::$app->params['report_balance_sheet']) && !empty(\Yii::$app->params['report_balance_sheet'])){
                    $report_help_text = \Yii::$app->params['report_balance_sheet'];
        }else{
            $report_help_text = '';
        }

    	$model = new BranchMaster();

    	$title = 'Balance Sheet';

    	return $this->render('balance_sheet',[
    			'model' => $model,
    			'title' => $title,
                'report_help_text' => $report_help_text
    		]);

    }

    public function actionProfitLoss(){

        if(isset(\Yii::$app->params['report_profit_loss']) && !empty(\Yii::$app->params['report_profit_loss'])){
                    $report_help_text = \Yii::$app->params['report_profit_loss'];
        }else{
            $report_help_text = '';
        }

    	$model = new BranchMaster();

    	$title = 'Profit & Loss';

    	return $this->render('balance_sheet',[
    			'model' => $model,
    			'title' => $title,
                'report_help_text' => $report_help_text
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