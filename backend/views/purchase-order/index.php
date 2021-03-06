<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

use yii\helpers\ArrayHelper;

use backend\models\Supplier;
use backend\models\Branch;
use backend\models\Currency;
use backend\models\PpPurchaseDetail;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PpPurchaseHeadSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Purchase Order';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-header">

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=Url::base('')?>">Home</a></li>
        <li class="breadcrumb-item">Purchase</li>

        <li class="breadcrumb-item active"><a href="<?= Url::toRoute(['/purchase-order']); ?>"><?= Html::encode($this->title) ?></a></li>
      </ol>
     
      <div class="middle-menu-bar">
        <?= Html::a(Yii::t('app', 'Create '.$this->title), ['create'], ['class' => '']) ?>   
        <?= Html::a(Yii::t('app', 'Manage '.$this->title), ['index'], ['class' => '']) ?>   
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
                if(isset(\Yii::$app->params['purchase_order_index']) && !empty(\Yii::$app->params['purchase_order_index'])){
                  echo \Yii::$app->params['purchase_order_index'];
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
                    'attribute' => 'po_order_number',
                    'label' => 'Purchase Order No',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return Html::a($model->po_order_number, ['/purchase-order/view', 'id' => $model->id]);
                    },
                  ],
                  [
                   'label' => 'Purchase Qty',
                   'value' => function ($model) {

                      $sales_qty = PpPurchaseDetail::total_purchase_qty($model->id);
                        
                      return $sales_qty;
                   }
                  ],
                  'date',
                  [
                   'attribute' => 'supplier_id',  
                   'label' => 'Supplier',
                   'filter'=>ArrayHelper::map(Supplier::find()->asArray()->all(), 'id', 'supplier_code'),
                   'value' => function ($model) {
                       return isset($model->supplier)?$model->supplier->supplier_code:'';
                   }
                  ],
                  'pay_terms',                
                  'delivery_date',
                  [
                   'attribute' => 'branch_id',  
                   'label' => 'Delivery to Branch',
                   'filter'=>ArrayHelper::map(Branch::find()->asArray()->all(), 'id', 'title'),
                   'value' => function ($model) {
                       return isset($model->branch)?$model->branch->title:'';
                   }
                 ],
                 [
                   'attribute' => 'currency_id',
                   'label' => 'Currency',
                   'filter'=>ArrayHelper::map(Currency::find()->asArray()->all(), 'id', 'currency_code'),
                   'value' => function ($model) {
                       return isset($model->currency)?$model->currency->currency_code:'';
                   }
                 ],
                 [
                   'attribute' => 'exchange_rate',  
                   'label' => 'Exchange Rate',
                   'value' => function ($model) {
                       return number_format($model->exchange_rate,3);
                   }
                 ],
                 [
                   'attribute' => 'discount_rate',  
                   'label' => 'Discount Rate',
                   'value' => function ($model) {
                       return number_format($model->discount_rate,3);
                   }
                 ],
                 [
                   'attribute' => 'note',  
                   'label' => 'Note',
                   'value' => function ($model) {
                       return $model->note;
                   }
                 ],
                 [
                   'attribute' => 'net_amount',  
                   'label' => 'Total Amount',
                   'value' => function ($model) {
                       return number_format($model->net_amount,3);
                   }
                 ],
                 
                  [
                    'attribute' => 'status',
                    'label' => 'Status',
                    'filter'=>array("open"=>"Open","grn-created"=>"Grn-created","approved"=>"Approved","part-received"=>"Part-received"),
                    'value' => function ($model){
                      return ucfirst($model->status);
                    }
                  ],
                  
                  [
                      'header' => 'Action',
                      'class' => 'yii\grid\ActionColumn',
                      'template' => '{view} {update}',
                      'buttons' => [
                        'update' => function ($url,$model) {
                            $url =  $url;
                            return $model->status == 'open'?Html::a('<span class="btn btn-xs btn-primary" title="Update">Edit </span>', $url):'';
                          },
                        'view' => function ($url,$model) {
                            $url =  $url;
                            return $model->status != 'cancel'?Html::a('<span class="btn btn-xs btn-info">Show </span>', $url):'';
                          },
                          
                        
                      ],
                  ],

                  [
                      'header' => 'Approve / Cancel PO',
                      'class' => 'yii\grid\ActionColumn',
                      'template' => '{approved} {cancel}',
                      'buttons' => [
                          'cancel' => function ($url, $model) {
                                return $model->status == 'open'?Html::a('Cancel', ['purchase-order/cancel', 'id' => $model->id], ['class' => 'btn btn-xs btn-danger', "data-pjax" => 0, 'onClick' => 'return confirm("Are you sure you want to cancel this purchased order?") ']):'';
                            },
                          'approved' => function ($url, $model) {
                                return $model->status == 'open'?Html::a('Approve', ['purchase-order/approved', 'id' => $model->id ], ['class' => 'btn btn-xs btn-success', "data-pjax" => 0, 'onClick' => 'return confirm("Are you sure you want to approved this purchased order?") ']):'';
                            },
                      ],
                  ],

                  [
                      'header' => 'Reports',
                      'class' => 'yii\grid\ActionColumn',
                      'template' => '{pdf}{xlsx}',
                      'buttons' => [
                          'pdf' => function ($url, $model) {
                                return Html::a('<span id="action-btn-pdf" class="action-btn-2" title="PDF">&nbsp;</span>', ['purchase-order/cancel', 'id' => $model->id], ["data-pjax" => 0, 'onClick' => 'return confirm("Are you sure you want to cancel this purchased order?") ']);
                            },

                            'xlsx' => function ($url, $model) {
                                return Html::a('<span id="action-btn-xls" class="action-btn-2" title="XLSX">&nbsp;</span>', ['purchase-order/cancel', 'id' => $model->id], ["data-pjax" => 0, 'onClick' => 'return confirm("Are you sure you want to cancel this purchased order?") ']);
                            },
                        
                      ],
                  ],

              ],
          ]); ?>
        </div>
      </div>

    </div>
</div>      
