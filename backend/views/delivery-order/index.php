<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

use yii\helpers\ArrayHelper;

use backend\models\Customer;
use backend\models\Branch;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SmHeadSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Delivery Order';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-header">

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=Url::base('')?>">Home</a></li>
        <li class="breadcrumb-item">Inventory</li>

        <li class="breadcrumb-item active"><a><?= Html::encode($this->title) ?></a></li>
      </ol>
     
      <div class="middle-menu-bar">
        
        <?php
          echo \yii\helpers\Html::a( '<i class="icon md-arrow-left" aria-hidden="true"></i> Back', Yii::$app->request->referrer,['class' => 'back']);
        ?>    
      </div>
</div>


<div class="page-content">

    <div class="row mt-20" data-plugin="matchHeight" data-by-row="true">

      <div class="col-xl-4 col-md-4">
          <!-- Widget Linearea One-->
          <div class="card card-shadow" id="widgetLineareaOne">
            <div class="card-block p-20 pt-10">
              <div class="clearfix">
                <div class="grey-800 float-left py-10">
                  <i class="icon md-chart grey-600 font-size-24 vertical-align-bottom mr-5"></i>     Today's delivered qty
                </div>
                <span class="float-right grey-700 font-size-30"><?=$todays_delivered?></span>
              </div>
              <div class="mb-20 grey-500">
                <i class="icon md-long-arrow-up green-500 font-size-16"></i> Today's delivered of <?=date('F');?>
              </div>
              
            </div>
          </div>
          <!-- End Widget Linearea One -->
        </div>

        <div class="col-xl-4 col-md-4">
          <!-- Widget Linearea One-->
          <div class="card card-shadow" id="widgetLineareaOne">
            <div class="card-block p-20 pt-10">
              <div class="clearfix">
                <div class="grey-800 float-left py-10">
                  <i class="icon md-chart grey-600 font-size-24 vertical-align-bottom mr-5"></i> This month delivered qty
                </div>
                <span class="float-right grey-700 font-size-30"><?=$this_month_delivered?></span>
              </div>
              <div class="mb-20 grey-500">
                <i class="icon md-long-arrow-up green-500 font-size-16"></i>
                Delivered of <?=date('F');?>
              </div>
              
            </div>
          </div>
          <!-- End Widget Linearea One -->
        </div>

        <div class="col-xl-4 col-md-4">
          <!-- Widget Linearea One-->
          <div class="card card-shadow" id="widgetLineareaOne">
            <div class="card-block p-20 pt-10">
              <div class="clearfix">
                <div class="grey-800 float-left py-10">
                  <i class="icon md-chart grey-600 font-size-24 vertical-align-bottom mr-5"></i> Pending delivery
                </div>
                <span class="float-right grey-700 font-size-30"><?=$pending_delivered?></span>
              </div>
              <div class="mb-20 grey-500">
                <i class="icon md-long-arrow-up green-500 font-size-16"></i>
                Total pending deliver
              </div>
              
            </div>
          </div>
          <!-- End Widget Linearea One -->
        </div>

    </div>

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

       <!-- <div id="flag_desc">
          <div id="flag_desc_text">
              <?php
                if(isset(\Yii::$app->params['inventory_delivery_order']) && !empty(\Yii::$app->params['inventory_delivery_order'])){
                  echo \Yii::$app->params['inventory_delivery_order'];
                }
              ?>              
          </div>
      </div> -->

      <div class="panel-body">

        <div class="table-responsive">

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                   # ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    [
                      'attribute' => 'sm_number',
                      'label' => 'Sales Number',
                      'format' => 'raw',
                      'value' => function ($model) {
                          return Html::a($model->sm_number, ['/sales-invoice/view', 'id' => $model->id]);
                      },
                    ],                   
                    'date',
                    [
                     'attribute' => 'customer_id',  
                     'label' => 'Customer Name',
                     'filter'=>ArrayHelper::map(Customer::find()->asArray()->all(), 'id', 'name'),
                     'value' => function ($model) {
                         return isset($model->customer)?$model->customer->name:'';
                     }
                    ],                    
                    'doc_type',
                    [
                     'attribute' => 'prime_amount',  
                     'label' => 'Total Amount',
                     'value' => function ($model) {
                         return number_format($model->prime_amount,3);
                     }
                   ],

                    [
                     'attribute' => 'tax_amount',  
                     'label' => 'Tax Amount',
                     'value' => function ($model) {
                         return number_format($model->tax_amount,3);
                     }
                   ],

                   [
                     'attribute' => 'discount_rate',  
                     'label' => 'Discount Rate (%)',
                     'value' => function ($model) {
                         return number_format($model->discount_rate,3);
                     }
                   ],
                   [
                     'attribute' => 'discount_amount',  
                     'label' => 'Discount Amount',
                     'value' => function ($model) {
                         return number_format($model->discount_amount,3);
                     }
                   ],
                   [
                     'attribute' => 'net_amount',  
                     'label' => 'Net Amount',
                     'value' => function ($model) {
                         return number_format($model->net_amount,3);
                     }
                   ],
                   
                    [
                      'attribute' => 'status',
                      'label' => 'Status',
                      'filter'=>array("open"=>"Open","confirmed"=>"Confirmed","invoiced"=>"Invoiced"),
                      'value' => function ($model){
                        return ucfirst($model->status);
                      }
                    ],
                    'gl_voucher_number',
                                    
                  /*[
                      'header' => 'Confirm Delivery',
                      'class' => 'yii\grid\ActionColumn',
                      'template' => '{delivery}',
                      'buttons' => [
                          'delivery' => function ($url, $model) {
                                return $model->status == 'confirmed'?Html::a('Confirm', ['delivery-order/delivery', 'id' => $model->id], ['class' => 'btn btn-xs btn-primary', "data-pjax" => 0, 'onClick' => 'return confirm("Are you sure you want to delivery?") ']):'';
                            },
                    ],
                    
                  ],*/

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
