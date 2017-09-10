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
      <div id="flag_desc">
          <div id="flag_desc_text">
              <?php
                if(isset(\Yii::$app->params['stock_view']) && !empty(\Yii::$app->params['stock_view'])){
                  echo \Yii::$app->params['stock_view'];
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

                'product_code',
                'title',
                'batch_number',
                'date',
                'branch_name',
                'branch_code',
                'cost_price',
                [
                    'label' => 'Unit',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return '';
                    },
                ],

                [
                    'label' => 'Transfer Quantity',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return '';
                    },
                ],

                [
                    'label' => 'Sell Quantity',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return '';
                    },
                ],
                
                [
                    'label' => 'Stock Quantity',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return $model->quantity;
                    },
                ],

                 [
                    'label' => 'Available Quantity',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return $model->quantity;
                    },
                ],
                #['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>

           

          </div>
          
      </div>

    </div>
    
</div>     
