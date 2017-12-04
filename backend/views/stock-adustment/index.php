<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

use yii\helpers\ArrayHelper;

use backend\models\Currency;
use backend\models\Branch;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ImAdjustHeadSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Stock Adjustment';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-header">

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=Url::base('')?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?=Url::base('')?>">Inventory</a></li>
        <li class="breadcrumb-item active"><?= Html::encode($this->title) ?></li>
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
                if(isset(\Yii::$app->params['stock_adjustment_index']) && !empty(\Yii::$app->params['stock_adjustment_index'])){
                  echo \Yii::$app->params['stock_adjustment_index'];
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
                            'attribute' => 'transaction_no',
                            'label' => 'Trasaction No',
                            'format' => 'raw',
                            'value' => function ($model) {
                                return Html::a($model->transaction_no, ['/stock-adustment/view', 'id' => $model->id]);
                            },
                        ],
                        'date',
                        [
                           'attribute' => 'branch_id',  
                           'label' => 'Branch',
                           'filter'=>ArrayHelper::map(Branch::find()->asArray()->all(), 'id', 'title'),
                           'value' => function ($model) {
                               return isset($model->branch)?$model->branch->title:'';
                           }
                        ],
                        'confirm_date',
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
                          'label' => 'Exch. Rate',
                          'value' => function($model){
                            return number_format($model->exchange_rate,3);
                          }
                        ],
                        [
                          'attribute' => 'status',
                          'label' => 'Status',
                          'filter'=>array("open"=>"Open","confirmed"=>"Confirmed"),
                          'value' => function ($model){
                            return ucfirst($model->status);
                          }
                        ],
                        'voucher_number',

                       [
                        'header' => 'Action',
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{view} {update} ',
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
                            'header' => 'Confirm Adjustment',
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{confirm_adjustment} ',
                            'buttons' => [
                                'confirm_adjustment' => function ($url, $model) {
                                      return $model->status == 'open'?Html::a('Confirm', ['stock-adustment/confirm-adjustment', 'id' => $model->id], ['class' => 'btn btn-xs btn-success', "data-pjax" => 0, 'onClick' => 'return confirm("Are you sure you want to confirm this dispatch?") ']):'';
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