<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ImGrnHeadSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'GRN History';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-header">

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=Url::base('')?>">Home</a></li>
        <li class="breadcrumb-item">Inventory</li>
        <li class="breadcrumb-item active"><?= Html::encode($this->title) ?></li>
      </ol>
     
      <div class="middle-menu-bar">
        <?= Html::a(Yii::t('app', 'GRN History'), ['/grn/grn-history'], ['class' => '']) ?>   
        <?= Html::a(Yii::t('app', 'Manage GRN'), ['/grn/manage-grn'], ['class' => '']) ?>   
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
            #'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                  'attribute' => 'po_order_number',
                  'label' => 'Purchase Order No',
                  'format' => 'raw',
                  'value' => function ($model) {
                      return Html::a($model->po_order_number, ['/purchase-order/view', 'id' => $model->id]);
                  },
                ],
                [
                 'label' => 'Supplier Id',
                 'value' => function ($model) {
                     return isset($model->supplier)?$model->supplier->supplier_code:'';
                 }
               ],
               [
                 'label' => 'Supplier Organization Name',
                 'value' => function ($model) {
                     return isset($model->supplier)?$model->supplier->org_name:'';
                 }
               ],
                [
                 'label' => 'Order Date',
                 'value' => function ($model) {
                     return $model->date;
                 }
               ],
                'delivery_date',
               
                [
                  'label' => 'PO Status',
                  'value' => function ($model){
                    return ucfirst($model->status);
                  }
                ],
                [
                    'header' => 'Action',
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{create_grn}',
                    'buttons' => [
                     
                        'create_grn' => function ($url, $model) {
                              return Html::a('<span class="glyphicon glyphicon-open-file" title="Create GRN"></span>', ['grn/create-grn', 'id' => $model->id], ["data-pjax" => 0, 'onClick' => 'return confirm("Are you sure you want to create this GRN?") ']);
                          },
                      
                    ],
                ],


            ],
        ]); ?>

      </div>

</div>      