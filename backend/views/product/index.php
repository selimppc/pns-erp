<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Products');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-header">

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=Url::base('')?>">Home</a></li>
        <li class="breadcrumb-item active">Product</li>
      </ol>
     
      <div class="middle-menu-bar">
        <?= Html::a(Yii::t('app', 'Create Product'), ['create'], ['class' => '']) ?>   
        <?= Html::a(Yii::t('app', 'Manage Products'), ['index'], ['class' => '']) ?>   
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

            #'id',
            'product_code',
            'title',
           # 'description:ntext',
           # 'image',
            // 'thumb_image',
             'class',
             'group',
            // 'category',
            // 'currency_id',
             'model',
             'size',
            // 'origin',
            // 'exchange_rate',
            // 'sell_rate',
            // 'cost_price',
            // 'sell_uom',
            // 'sell_uom_qty',
            // 'purchase_uom',
            // 'purchase_uom_qty',
            // 'sell_tax',
            // 'stock_uom',
            // 'stock_uom_qty',
            // 'pack_size',
            // 'stock_type',
            // 'generic',
            // 'supplier_id',
            // 'manufacturer_year',
            // 'max_level',
            // 'min_level',
            // 're_order',
            // 'created_by',
            // 'updated_by',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


      </div>

    </div>

</div>

