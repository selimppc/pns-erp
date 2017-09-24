<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

use yii\helpers\ArrayHelper;

use backend\models\Branch;
use backend\models\Currency;
use backend\models\Supplier;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ImGrnHeadSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Invoice';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-header">

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=Url::base('')?>">Home</a></li>
        <li class="breadcrumb-item">Account Payable</li>        
        <li class="breadcrumb-item active"><?= Html::encode($this->title) ?></li>
      </ol>
     
      <div class="middle-menu-bar">
       
        <?= Html::a(Yii::t('app', 'GRN List for Create Invoice'), [''], ['class' => '']) ?>    
        <?php
          echo \yii\helpers\Html::a( '<i class="icon md-arrow-left" aria-hidden="true"></i> Back', Yii::$app->request->referrer,['class' => 'back']);
        ?>    
      </div>
</div>


<div class="page-content">
    <!-- Panel Basic -->
    <div class="panel">

        <?php 
            if(Yii::$app->session->hasFlash('success')){
        ?>
            <div class="alert alert-success">
              <?= Yii::$app->session->getFlash('success'); ?>
            </div>
        <?php 
            }
        ?>

        <?php 
            if(Yii::$app->session->hasFlash('error')){
        ?>
            <div class="alert alert-danger">
              <?= Yii::$app->session->getFlash('error'); ?>
            </div>
        <?php 
            }
        ?>

      <div id="flag_desc">
            <div id="flag_desc_text">
                <?php
                    if(isset(\Yii::$app->params['account_payable_invoice']) && !empty(\Yii::$app->params['account_payable_invoice'])){
                      echo \Yii::$app->params['account_payable_invoice'];
                    }
                ?>
            </div>
        </div>
     
      <div class="panel-body">

        <div class="table-responsive">

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                   # ['class' => 'yii\grid\SerialColumn'],
                    'id',
                    [
                      'attribute' => 'grn_number',
                      'label' => 'GRN Number',
                      'format' => 'raw',
                      'value' => function ($model) {

                        if($model->status == 'open'){
                        
                          return Html::a($model->grn_number, ['grn/generate-grn', 'po' => isset($model->ppPurchaseHead)?$model->ppPurchaseHead->po_order_number:'','grn'=>$model->grn_number]);
                        
                        }else{
                          return Html::a($model->grn_number, ['grn/view', 'id' => $model->id]);
                        }

                      },
                    ],
                    [
                      'attribute' => 'supplier_id',
                      'label' => 'Supplier',
                      'filter'=>ArrayHelper::map(Supplier::find()->asArray()->all(), 'id', 'supplier_code'),
                      'format' => 'raw',
                      'value' => function ($model) {
                          return isset($model->supplier)?$model->supplier->supplier_code:'';
                      },
                    ],
                    [
                      'attribute' => 'branch_id',
                      'label' => 'Branch',
                      'filter'=>ArrayHelper::map(Branch::find()->asArray()->all(), 'id', 'title'),
                      'format' => 'raw',
                      'value' => function ($model) {
                          return isset($model->branch)?$model->branch->title:'';
                      },
                    ],
                    'date',
                    'voucher_number',
                    [
                      'attribute' => 'pp_purchase_head_id',
                      'label' => 'Purchase Order No',
                      'format' => 'raw',
                      'value' => function ($model) {
                          return isset($model->ppPurchaseHead)?$model->ppPurchaseHead->po_order_number:'';
                      },
                    ],
                    'pay_terms',
                    'prime_amount',
                    [
                      'attribute' => 'currency_id',
                      'label' => 'Currency',
                      'filter'=>ArrayHelper::map(Currency::find()->asArray()->all(), 'id', 'currency_code'),
                      'format' => 'raw',
                      'value' => function ($model) {
                          return isset($model->currency)?$model->currency->currency_code:'';
                      },
                    ],
                    'net_amount',                   
                    
                    [
                      'attribute' => 'status',
                      'label' => 'Status',
                      'filter'=>array("invoiced"=>"invoiced","confirmed"=>"Confirmed"),
                      'value' => function ($model){
                        return ucfirst($model->status);
                      }
                    ],

                    [
                      'header' => 'Action',
                      'class' => 'yii\grid\ActionColumn',
                      'template' => '{create_invoice}',
                      'buttons' => [
                        
                          'create_invoice' => function ($url, $model) {
                                return $model->status != 'invoiced'?Html::a('Create Invoice', ['account-payable-invoice/create-invoice', 'id' => $model->id], ["class"=>"btn btn-xs btn-success", "data-pjax" => 0, 'onClick' => 'return confirm("Are you sure you want to Create Invoice?") ']):'';
                            },
                        
                      ],
                    ],

                    [
                      'header' => 'VAT',
                      'class' => 'yii\grid\ActionColumn',
                      'template' => '{vat}',
                      'buttons' => [
                        
                          'vat' => function ($url, $model) {
                                return $model->status != 'invoiced'?Html::a('VAT', ['', 'id' => $model->id], ["class"=>"btn btn-xs btn-success", "data-pjax" => 0, 'onClick' => 'return confirm("Are you sure you want to add Vat?") ']):'';
                            },
                        
                      ],
                    ],
                ],
            ]); ?>

          </div>  

      </div>

    </div>
</div>    
