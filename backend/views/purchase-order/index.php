<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

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

        <li class="breadcrumb-item active"><a href="<?= Url::toRoute(['/pp-purchase-head']); ?>"><?= Html::encode($this->title) ?></a></li>
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

      <header class="panel-heading">
        <div class="panel-actions"></div>
        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
      </header>
     
      <div class="panel-body">

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'id',
                [
                  'attribute' => 'po_order_number',
                  'label' => 'Purchase Order No',
                  'format' => 'raw',
                  'value' => function ($model) {
                      return Html::a($model->po_order_number, ['/purchase-order/view', 'id' => $model->id]);
                  },
                ],
                'date',
                [
                 'label' => 'Supplier',
                 'value' => function ($model) {
                     return isset($model->supplier)?$model->supplier->supplier_code:'';
                 }
               ],
               'pay_terms',                
                'delivery_date',
                [
                 'label' => 'Delivery to Branch',
                 'value' => function ($model) {
                     return isset($model->branch)?$model->branch->title:'';
                 }
               ],
                [
                  'label' => 'Status',
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
                          return $model->status == 'open'?Html::a('<span class="btn btn-xs btn-info">Show </span>', $url):'';
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
                              return $model->status == 'open'?Html::a('<span id="action-btn-pdf" class="action-btn-2" title="PDF">&nbsp;</span>', ['purchase-order/cancel', 'id' => $model->id], ["data-pjax" => 0, 'onClick' => 'return confirm("Are you sure you want to cancel this purchased order?") ']):'';
                          },

                          'xlsx' => function ($url, $model) {
                              return $model->status == 'open'?Html::a('<span id="action-btn-xls" class="action-btn-2" title="XLSX">&nbsp;</span>', ['purchase-order/cancel', 'id' => $model->id], ["data-pjax" => 0, 'onClick' => 'return confirm("Are you sure you want to cancel this purchased order?") ']):'';
                          },
                      
                    ],
                ],

            ],
        ]); ?>

      </div>

    </div>
</div>      
