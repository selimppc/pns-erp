<?php

namespace backend\controllers;

use Yii;
use backend\models\ImGrnHead;
use backend\models\ImGrnHeadSearch;
use backend\models\ImGrnDetail;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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

    public function actionCreateGrn($po='',$grn=''){

        $purchased_order = PpPurchaseHead::find()->where(['po_order_number' => $po])->one();

        if(!empty($purchased_order)){
            $purchased_order_details = PpPurchaseDetail::find()->where(['pp_purchase_head_id' => $purchased_order->id])->all();    
        }else{
            $purchased_order_details = '';
        }

        $grn_head = ImGrnHead::find()->where(['grn_number' => $grn])->one();

        if(!empty($grn_head)){
            $grn_details = ImGrnDetail::find()->where(['im_grn_head_id'=>$grn_head->id])->all();
        }else{
            $grn_details = '';
        }
        

        $model = new ImGrnDetail();

        return $this->render('create_grn',[
                'po' => $po,
                'grn' => $grn,
                'purchased_order_details' => $purchased_order_details,
                'grn_details' => $grn_details,
                'model' => $model
            ]);

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
        return $this->render('view', [
            'model' => $this->findModel($id),
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