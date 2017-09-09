<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ImGrnDetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Stock View';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-header">

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=Url::base('')?>">Home</a></li>
        <li class="breadcrumb-item">Inventory</li>
                <li class="breadcrumb-item active"><?= Html::encode($this->title) ?></li>
      </ol>
     
      <div class="middle-menu-bar">
          
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

                    [
                      'attribute' => 'product_id',
                      'label' => 'Product Name',
                      'format' => 'raw',
                      'value' => function ($model) {
                          return isset($model->product)?$model->product->title:'';
                      },
                    ],
                    'batch_number',
                    'expire_date',
                    'receive_quantity',
                    [
                      'attribute' => 'cost_price',
                      'label' => 'Cost Price',
                      'format' => 'raw',
                      'value' => function ($model) {
                          return number_format($model->cost_price,2);
                      },
                    ],
                    [
                      'attribute' => 'uom',
                      'label' => 'UOM',
                      'format' => 'raw',
                      'value' => function ($model) {
                          return isset($model->productUom)?$model->productUom->title:'';
                      },
                    ],
                    'quantity',
                    [
                      'attribute' => 'row_amount',
                      'label' => 'Total Amount',
                      'format' => 'raw',
                      'value' => function ($model) {
                          return number_format($model->row_amount,2);
                      },
                    ],
                    // 'created_by',
                    // 'updated_by',
                    // 'created_at',
                    // 'updated_at',

                    //['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>

      </div>

    </div>
    
</div>     
