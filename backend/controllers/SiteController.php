<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

use backend\models\SmHead;
use backend\models\VwImStockView;
use backend\models\PpPurchaseHead;
use backend\models\VwSmMrReceive;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
       // Calculate todays & current month sales
        $current_date = Date('Y-m-d');
        
        $start_date = date('Y-m-01',strtotime('this month'));
        $end_date = date('Y-m-t',strtotime('this month'));


        // Last 15 days 
        $last_date = date('Y-m-d', strtotime("-1 days"));
        $last_15_date = date('Y-m-d', strtotime('-15 days'));

        // First day of current year
        $first_day_of_current_year = date('Y-m-d', strtotime('first day of january this year'));
        $last_day_of_current_year = date('Y-m-d', strtotime('last day of december this year'));

        // Sales data
        $todays_sale = SmHead::total_sales_value($current_date) ;
        $this_month_sale = SmHead::total_sales_value($start_date,$end_date);
        $last_15_days_sale = SmHead::total_sales_value($last_15_date,$last_date);
        $this_year_sale = SmHead::total_sales_value($first_day_of_current_year,$last_day_of_current_year);
        $all_sales = SmHead::total_sales_value();
        
        // Collection data
        $all_collection = SmHead::total_collection();
        $todays_collection = SmHead::total_collection($current_date) ;
        $this_month_collection = SmHead::total_collection($start_date,$end_date);
        $this_year_collection = SmHead::total_collection($first_day_of_current_year,$last_day_of_current_year);
        $last_15_days_collection = SmHead::total_collection($last_15_date,$last_date);

        // Dhaka branch quantity
        $dhaka_branch_qty = VwImStockView::total_qty_branch(1);    

        // Savar branch quantity
        $savar_branch_qty = VwImStockView::total_qty_branch(2);    

        // PO approved qty
        $po_approved_qty = PpPurchaseHead::total_po_qty('approved');

        // PO open qty
        $po_open_qty = PpPurchaseHead::total_po_qty('open');

        // TODO :: Find total due
        $total_due = VwSmMrReceive::total_due();


        // Delivery order

        $todays_delivered = SmHead::total_delievered_qty($current_date,'','delivered') ;
        $this_month_delivered = SmHead::total_delievered_qty($start_date,$end_date,'delivered') ;
        $pending_delivered = SmHead::total_delievered_qty('','','confirmed') ;


        return $this->render('index',[
            'todays_sale' => $todays_sale,
            'last_15_days_sale' => $last_15_days_sale,
            'this_month_sale' => $this_month_sale,
            'all_sales' => $all_sales,
            'dhaka_branch_qty' => $dhaka_branch_qty,
            'savar_branch_qty' => $savar_branch_qty,
            'po_approved_qty' => $po_approved_qty,
            'todays_delivered' => $todays_delivered,
            'this_month_delivered' => $this_month_delivered,
            'pending_delivered' => $pending_delivered,
            'total_due' => $total_due,
            'all_collection' => $all_collection,
            'todays_collection' => $todays_collection,
            'this_month_collection' => $this_month_collection,
            'last_15_days_collection' => $last_15_days_collection,
            'this_year_sale' => $this_year_sale,
            'this_year_collection' => $this_year_collection,
            'po_open_qty' => $po_open_qty
        ]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {

        $this->layout='login_layout';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }


        $model = new LoginForm();


        if ($model->load(Yii::$app->request->post()) && $model->login()) {
         
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
