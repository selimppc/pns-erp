<?php

namespace backend\controllers;

use Yii;
use backend\models\ImGrnHead;
use backend\models\ImGrnHeadSearch;

use backend\models\ImGrnDetail;
use backend\models\ImGrnDetailSearch;

use backend\models\VwPurchaseDetail;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;

use backend\models\PpPurchaseHead;
use backend\models\PpPurchaseDetail;
use backend\models\PpPurchaseHeadSearch;
use backend\models\TransactionCode;

/**
 * ImGrnHeadController implements the CRUD actions for ImGrnHead model.
 */
class GrnController extends Controller
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

    public function actionGrnHistory(){

        $searchModel = new PpPurchaseHeadSearch();
        $searchModel->status = 'approved';


        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        // Generate Transaction Code
        $grn_transaction_number = TransactionCode::generate_transaction_number('GRN-');
        
        if(empty($grn_transaction_number)){
            $grn_transaction_number = '';
        }

        return $this->render('grnhistory',[
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'grn_transaction_number' => $grn_transaction_number
            ]);
    }

    public function actionCreateGrn($po='',$grn='',$id=''){

        // Purchase Order Data
        $purchased_order = PpPurchaseHead::find()->where(['po_order_number' => $po])->one();

        if(!empty($purchased_order)){
            $purchased_order_details = PpPurchaseDetail::find()->where(['pp_purchase_head_id' => $purchased_order->id])->all();    
        }else{
            $purchased_order_details = '';
        }

        // Update GRN Transaction Code
        TransactionCode::update_transaction_number('GRN-');

        // Generate GRN Transaction Code
        $grn = TransactionCode::generate_transaction_number('GRN-');

        if(empty($grn)){
            $grn = '';
        }

        // save GRN Head Data
        $grn_head = new ImGrnHead();
        $grn_head->grn_number = $grn;
        $grn_head->status = 'open';
        $grn_head->pp_purchase_head_id = $purchased_order->id;
        $grn_head->supplier_id = $purchased_order->supplier_id;
        $grn_head->date = $purchased_order->date;
        $grn_head->pay_terms = $purchased_order->pay_terms;
        $grn_head->branch_id = $purchased_order->branch_id;
        $grn_head->prime_amount = $purchased_order->prime_amount;
        $grn_head->net_amount = $purchased_order->net_amount;

        $grn_head->save();


        return $this->redirect(array('grn/generate-grn', 'po' => $po, 'grn' => $grn, 'id' => $id));
        
        

    }

    public function actionGenerateGrn($po='',$grn='',$id=''){

        // Purchase Order Data
        $purchased_order = PpPurchaseHead::find()->where(['po_order_number' => $po])->one();

        if(!empty($purchased_order)){
            $purchased_order_details = PpPurchaseDetail::find()->where(['pp_purchase_head_id' => $purchased_order->id])->all(); 

            $purchased_order_details = VwPurchaseDetail::find()->where(['pp_purchase_head_id' => $purchased_order->id])->all();

            /*$query = new Query;
            $query  ->select(['pp_purchase_detail.id as id',
                'pp_purchase_detail.product_id as product_id',
                'product.title as product_title',
                'pp_purchase_detail.uom as uom',
                'codes_param.title as uom_title',
                'pp_purchase_detail.uom_quantity as uom_quantity',
                'pp_purchase_detail.quantity as quantity',
                'pp_purchase_detail.purchase_rate as purchase_rate'
               ])  
                ->from('pp_purchase_detail')
                ->where(['pp_purchase_detail.pp_purchase_head_id'=>$purchased_order->id])
                ->leftJoin('im_grn_head', 'im_grn_head.pp_purchase_head_id = pp_purchase_detail.pp_purchase_head_id')
                ->InnerJoin('im_grn_detail', 'im_grn_detail.im_grn_head_id = im_grn_head.id')
                ->InnerJoin('product', 'product.id = pp_purchase_detail.product_id')
                ->InnerJoin('codes_param', 'codes_param.id = pp_purchase_detail.uom')
                ->distinct();
                
        $command = $query->createCommand();
        $purchased_order_details = $command->queryAll();*/



        }else{
            $purchased_order_details = '';
        }

        $grn_head = ImGrnHead::find()->where(['grn_number' => $grn])->one();

        if(!empty($grn_head)){

            // get Grn Details Data
            $grn_details = ImGrnDetail::find()->where(['im_grn_head_id'=>$grn_head->id])->all();

        }else{
            $grn_details = '';

        }
        

        $model = new ImGrnDetail();
        $model->grn_number = $grn;

        if(!empty($id)){

            $transaction_head = PpPurchaseHead::find()->where(['po_order_number'=>$po])->one();

            $transaction_details = PpPurchaseDetail::find()->where(['product_id'=>$id])->andWhere(['pp_purchase_head_id'=>$transaction_head->id])->one();

            

            if(!empty($transaction_details)){

                // Set up Grn Details data
                $model->product_id = $transaction_details->product_id;
                $model->expire_date = $transaction_head->delivery_date;
                $model->uom = $transaction_details->uom;
                $model->quantity = $transaction_details->uom_quantity;
                $model->receive_quantity = $transaction_details->quantity;
                $model->cost_price = $transaction_details->purchase_rate;
                $model->row_amount = $transaction_details->purchase_rate * $transaction_details->quantity;                
            }

            // Grn Details Data Save
           
            if ($model->load(Yii::$app->request->post()))
            {
                $model->im_grn_head_id = $grn_head->id;

                $valid = $model->validate();
                if($valid){

                    $model->row_amount = $transaction_details->purchase_rate * $model->quantity;

                    $model->save(); 

                    $model = new ImGrnDetail();
                    $model->grn_number = $grn; 

                    // Set success data
                    \Yii::$app->getSession()->setFlash('success', 'Successfully Inserted');

                    return $this->redirect(['grn/generate-grn','po' => $po,'grn' => $grn]);  
                }else{
                    print_r($model->getErrors());
                    exit();
                }
                

            }

        }

        return $this->render('create_grn',[
                'po' => $po,
                'grn' => $grn,
                'purchased_order_details' => $purchased_order_details,
                'grn_details' => $grn_details,
                'model' => $model
            ]);

    }

    public function actionDeleteGrn($po='',$grn='',$id=''){

        $grn_details = ImGrnDetail::find()->where(['id'=>$id])->one();

        if(!empty($grn_details)){

            // Set success data
            \Yii::$app->getSession()->setFlash('success', 'Successfully Deleted');

            $grn_details->delete();

        }

        return $this->redirect(['grn/generate-grn','po' => $po,'grn' => $grn]);
    }


    public function actionManageGrn(){

        $searchModel = new ImGrnHeadSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionConfirmGrn($id){

        $model = ImGrnHead::find()->where(['id' => $id])->one();
        $im_grn_head_id = $id;


        $result = \Yii::$app->db->createCommand("CALL sp_im_confirm_grn(:grn_head_id, :user_id)") 
                      ->bindValue(':grn_head_id' , $im_grn_head_id )
                      ->bindValue(':user_id', Yii::$app->user->id)
                      ->execute();    
            
        if($model){

            // $model->status = 'confirmed';

            /*$valid = $model->validate();
            if($valid){

                // Set success data
                \Yii::$app->getSession()->setFlash('success', 'Successfully Confirm GRN');

                $model->save();    
            }else{
                print_r($model->getErrors());
                exit();
            }*/
            

           
        }

        return $this->redirect(['index']);

    }

    /**
     * Lists all ImGrnHead models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ImGrnHeadSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ImGrnHead model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {

        $model = ImGrnHead::find()->where(['id'=>$id])->one();

        $searchModel = new ImGrnDetailSearch();
        $searchModel->im_grn_head_id = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        return $this->render('/im-grn-detail/index', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new ImGrnHead model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ImGrnHead();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ImGrnHead model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ImGrnHead model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ImGrnHead model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ImGrnHead the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ImGrnHead::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
