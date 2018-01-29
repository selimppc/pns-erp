<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

use yii\helpers\ArrayHelper;

use backend\models\Branch;
use backend\models\CodesParam;

use backend\models\VwImStockView;

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


    <div class="row mt-20" data-plugin="matchHeight" data-by-row="true">

        <div class="col-xl-4 col-md-4">
          <!-- Widget Linearea One-->
          <div class="card card-shadow" id="widgetLineareaOne">
            <div class="card-block p-20 pt-10" style="background: #63c2de;">
              <div class="clearfix">
                <div class="white float-left py-10">
                  <i class="icon md-chart white font-size-24 vertical-align-bottom mr-5"></i>     Dhaka
                </div>
                <span class="float-right white font-size-30"><?=$dhaka_branch_qty?></span>
              </div>
              <div class="mb-20 white">
                <i class="icon md-long-arrow-up white font-size-16"></i> Stock of Dhaka
              </div>
              
            </div>
          </div>
          <!-- End Widget Linearea One -->
        </div>

        <div class="col-xl-4 col-md-4">
          <!-- Widget Linearea One-->
          <div class="card card-shadow" id="widgetLineareaOne">
            <div class="card-block p-20 pt-10" style="background: #20a8d8;">
              <div class="clearfix">
                <div class="white float-left py-10">
                  <i class="icon md-chart white font-size-24 vertical-align-bottom mr-5"></i> Savar
                </div>
                <span class="float-right white font-size-30"><?=$savar_branch_qty?></span>
              </div>
              <div class="mb-20 white">
                <i class="icon md-long-arrow-up white font-size-16"></i>
                Stock of Savar
              </div>
              
            </div>
          </div>
          <!-- End Widget Linearea One -->
        </div>

        <div class="col-xl-4 col-md-4">
          <!-- Widget Linearea One-->
          <div class="card card-shadow" id="widgetLineareaOne">
            <div class="card-block p-20 pt-10" style="background: #ffc107;">
              <div class="clearfix">
                <div class="white float-left py-10">
                  <i class="icon md-chart white font-size-24 vertical-align-bottom mr-5"></i> Upcoming Quantity
                </div>
                <span class="float-right white font-size-30">0</span>
              </div>
              <div class="mb-20 white">
                <i class="icon md-long-arrow-up white font-size-16"></i>
                Approved purchased
              </div>
              
            </div>
          </div>
          <!-- End Widget Linearea One -->
        </div>

    </div>

    <!-- Panel Basic -->
    <div class="panel">
        <!-- <div id="flag_desc">
          <div id="flag_desc_text">
              <?php
                if(isset(\Yii::$app->params['stock_view']) && !empty(\Yii::$app->params['stock_view'])){
                  echo \Yii::$app->params['stock_view'];
                }
              ?>              
          </div>
        </div> -->

      <div class="panel-body">

        

        <div class="table-responsive">

          <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'rowOptions'=>function($model){
                if($model->available <= 10){
                    #return ['class' => 'red'];
                }
            },

            'columns' => [
                [
                  'class' => 'yii\grid\SerialColumn',
                  'header' => 'No'
                ],
                
                'product_model',
                
                [
                    'attribute' => 'sell_rate',
                    'label' => 'Sell Rate',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return number_format($model->sell_rate,3);
                    },
                ],
               
               /*[
                    'attribute' => 'im_rate',
                    'label' => 'IM Rate',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return number_format($model->im_rate,3);
                    },
                ],*/

                
                [
                    'attribute' => 'branch_id',
                    'filter'=>ArrayHelper::map(Branch::find()->asArray()->all(), 'id', 'title'),
                    'label' => 'Branch',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return isset($model->branch)?$model->branch->title:'';
                    },
                ],
                
                [
                    'attribute' => 'inhandQty',
                    'label' => 'Total Purchased Qty',
                    'format' => 'raw',
                    'value' => function ($model) {
                        $avilable_value = VwImStockView::total_inhandQty($model->product_id,$model->branch_id);
                        return $avilable_value;
                    }
                ],
                [
                    'attribute' => 'saleQty',
                    'label' => 'Sale Qty',
                    'format' => 'raw',
                    'value' => function ($model) {
                        $avilable_value = VwImStockView::total_saleQty($model->product_id,$model->branch_id);
                        return $avilable_value;
                    }
                ],
                
                [
                    'attribute' => 'available',
                    'label' => 'Available Qty',
                    'format' => 'raw',
                    'value' => function ($model) {
                        $avilable_value = VwImStockView::total_available($model->product_id,$model->branch_id);
                        return $avilable_value;
                    }
                ],
                [
                    'attribute' => 'product_title',
                    'label' => 'Product Name',
                    'format' => 'raw',
                    'value' => function ($model) {
                        $data = '<b>'.$model->product_title.'</b><br/><b>Code : </b>'.$model->product_code;
                        return $data;
                    },
                ],

                'product_style',

                [
                    'attribute' => 'uom',
                    'label' => 'UOM',
                    'filter'=>ArrayHelper::map(CodesParam::find()->where(['type'=>'Unit Of Measurement'])->asArray()->all(), 'id', 'title'),
                    'format' => 'raw',
                    'value' => function ($model) {
                        return isset($model->productUom)?$model->productUom->title:'';
                    },
                ],

                [
                    'attribute' => 'product_description',
                    'label' => 'Description',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return $model->product_description;
                    },
                ],
                [
                   # 'attribute' => 'product_id',
                    'label' => 'Total',
                    'format' => 'raw',
                    'value' => function ($model) {
                        $total_value = VwImStockView::findtotal_available($model->product_id);
                        return $total_value;
                    },
                ],
               
               
                #['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>

           

          </div>
          
      </div>

    </div>
    
</div>     
<style type="text/css">
    b{
        font-weight: 700;
    }
</style>