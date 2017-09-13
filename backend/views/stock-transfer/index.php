<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ImTransferHeadSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Stock Transfer';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-header">

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=Url::base('')?>">Home</a></li>
        <li class="breadcrumb-item">Inventory</li>
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
                if(isset(\Yii::$app->params['stock_transfer_index']) && !empty(\Yii::$app->params['stock_transfer_index'])){
                  echo \Yii::$app->params['stock_transfer_index'];
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
            #['class' => 'yii\grid\SerialColumn'],
            'id',
            [
              'attribute' => 'transfer_number',
              'label' => 'Transfer Number',
              'format' => 'raw',
              'value' => function ($model) {
                  return Html::a($model->transfer_number, ['/stock-transfer/view', 'id' => $model->id]);
              },
            ],
            'date',
            'confirm_date',
            [
               'attribute' => 'from_branch_id',  
               'label' => 'From Branch',
               'value' => function ($model) {
                   return isset($model->fromBranch)?$model->fromBranch->title:'';
               }
            ],

            [
               'attribute' => 'from_currency_id',  
               'label' => 'From Currency',
               'value' => function ($model) {
                   return isset($model->fromCurrency)?$model->fromCurrency->title:'';
               }
            ],                       
            'from_exchange_rate',
            [
               'attribute' => 'tp_branch_id',  
               'label' => 'To Branch',
               'value' => function ($model) {
                   return isset($model->toBranch)?$model->toBranch->title:'';
               }
            ],

            [
               'attribute' => 'to_currency_id',  
               'label' => 'Top Currency',
               'value' => function ($model) {
                   return isset($model->toCurrency)?$model->toCurrency->title:'';
               }
            ], 
            'to_exchange_rate',
            [
              'attribute' => 'status',
              'label' => 'Status',
              'value' => function ($model){
                return ucfirst($model->status);
              }
            ],

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
                'header' => 'Confirm Dispatch',
                'class' => 'yii\grid\ActionColumn',
                'template' => '{confirm_dispatch} {cancel}',
                'buttons' => [
                    'confirm_dispatch' => function ($url, $model) {
                          return $model->status == 'open'?Html::a('Confirm', ['stock-transfer/confirm-dispatch', 'id' => $model->id], ['class' => 'btn btn-xs btn-success', "data-pjax" => 0, 'onClick' => 'return confirm("Are you sure you want to confirm this dispatch?") ']):'';
                    },
                    'cancel' => function ($url, $model) {
                          return $model->status == 'open'?Html::a('Cancel', ['stock-transfer/cancel', 'id' => $model->id], ['class' => 'btn btn-xs btn-danger', "data-pjax" => 0, 'onClick' => 'return confirm("Are you sure you want to cancel this order?") ']):'';
                    },
                ],
            ],
        ],
    ]); ?>

      </div>
      </div>

    </div> 
</div>    
