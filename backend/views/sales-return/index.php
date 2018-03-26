<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

use yii\helpers\ArrayHelper;

use backend\models\Customer;
use backend\models\SalesPerson;
use backend\models\Branch;
use backend\models\SmHead;
use backend\models\SmDetail;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SmHeadSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sales Return';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-header">

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=Url::base('')?>">Home</a></li>
        <li class="breadcrumb-item">Sales</li>

        <li class="breadcrumb-item active"><a href="<?= Url::toRoute(['/sales-invoice']); ?>"><?= Html::encode($this->title) ?></a></li>
      </ol>
     
      <div class="middle-menu-bar">
        <?= Html::a(Yii::t('app', 'Choose Invoice for'.$this->title), ['choose-invoice'], ['class' => '']) ?>   
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

       <!-- <div id="flag_desc">
          <div id="flag_desc_text">
              <?php
                if(isset(\Yii::$app->params['invoice_entry_index']) && !empty(\Yii::$app->params['invoice_entry_index'])){
                  echo \Yii::$app->params['invoice_entry_index'];
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
                    'note',              
                    'date',
                    [
                     'attribute' => 'customer_id',  
                     'label' => 'Customer Name',
                     'filter'=>ArrayHelper::map(Customer::find()->asArray()->all(), 'id', 'name'),
                     'value' => function ($model) {
                         return isset($model->customer)?$model->customer->name:'';
                     }
                    ],
                    [
                     #'attribute' => 'customer_id',  
                     'label' => 'Product Model',
                     'value' => function ($model) {
                        $product_model = '';
                        if(!empty($model->smDetails))
                        {
                          $product_count = 1;
                          $total_product_model = count($model->smDetails);
                          foreach($model->smDetails as $key => $sales_details)
                          {
                              $product_model.=isset($sales_details->product->model)?$sales_details->product->model:'';
                              
                              if($product_count<$total_product_model)
                              {
                                $product_model.= ', ';
                              }

                              $product_count++;  
                          }
                        }  
                        return $product_model;
                     }
                    ],

                    [
                     #'attribute' => 'customer_id',  
                     'label' => 'Sales Qty',
                     'value' => function ($model) {

                        $sales_qty = SmDetail::total_sales_qty($model->id);
                          
                        return $sales_qty;
                     }
                    ],

                    [
                     'attribute' => 'prime_amount',  
                     'label' => 'Total Amount',
                     'value' => function ($model) {
                         return number_format($model->prime_amount,3);
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
                     'attribute' => 'commission',  
                     'label' => 'Commission',
                     'value' => function ($model) {
                        $commission_value = ($model->net_amount * $model->commission)/100;
                        return !empty($model->commission)?$model->commission.'%':'';
                     }
                   ],
                 
                   
                    [
                     'attribute' => 'sales_person_id',  
                     'label' => 'Sales Person',
                     'filter'=>ArrayHelper::map(SalesPerson::find()->asArray()->all(), 'id', 'name'),
                     'value' => function ($model) {
                         return isset($model->salesperson)?$model->salesperson->name:'';
                     }
                    ],
                    [
                     'attribute' => 'branch_id',  
                     'label' => 'Branch',
                     'filter'=>ArrayHelper::map(Branch::find()->asArray()->all(), 'id', 'title'),
                     'value' => function ($model) {
                         return isset($model->branch)?$model->branch->title:'';
                     }
                   ],
                    [
                      'attribute' => 'pay_terms',
                      'label' => 'Pay Terms',
                      'filter'=>array("Cash"=>"Cash","Credit"=>"Credit"),
                      'value' => function ($model){
                        return ucfirst($model->pay_terms);
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
                    [
                      'header' => 'View | Cancel Invoice',
                      'class' => 'yii\grid\ActionColumn',
                      'template' => '{view} {cancel}',
                      'buttons' => [
                          'view' => function ($url,$model) {
                            $url =  $url;
                            return Html::a('<span class="btn btn-xs btn-info">Show </span>', $url);
                          },
                          'cancel' => function ($url, $model) {
                                return $model->status == 'open'?Html::a('Cancel', ['sales-invoice/cancel', 'id' => $model->id], ['class' => 'btn btn-xs btn-danger', "data-pjax" => 0, 'onClick' => 'return confirm("Are you sure you want to cancel this invoice?") ']):'';
                            },
                    ],

                  ],                 
                  [
                      'header' => 'Confirm Invoice',
                      'class' => 'yii\grid\ActionColumn',
                      'template' => '{confirm}',
                      'buttons' => [
                          'confirm' => function ($url, $model) {
                                return $model->status == 'open'?Html::a('Confirm', ['sales-invoice/confirm', 'id' => $model->id], ['class' => 'btn btn-xs btn-primary', "data-pjax" => 0, 'onClick' => 'return confirm("Are you sure you want to confirm this invoice?") ']):'';
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
