<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;

use yii\helpers\ArrayHelper;

use backend\models\CodesParam;
use backend\models\Currency;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Products');
$this->params['breadcrumbs'][] = $this->title;
?>
<?php Pjax::begin(); ?> 
<div class="page-header">

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=Url::base('')?>">Home</a></li>
        <li class="breadcrumb-item">Master Setup</li>
        <li class="breadcrumb-item active">Product</li>
      </ol>
     
      <div class="middle-menu-bar">
        <?= Html::a(Yii::t('app', 'Add New Product'), ['create'], ['class' => '']) ?>
        <?= Html::a(Yii::t('app', 'Manage Products'), ['index'], ['class' => '']) ?>   
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
              <?=\Yii::$app->params['product_master_index']?>
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
                    'attribute' => 'product_code',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return Html::a($model->product_code, ['/product/view', 'id' => $model->id]);
                    },
                 ], 
                 [
                    'attribute' => 'title',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return Html::a($model->title, ['/product/view', 'id' => $model->id]);
                    },
                 ],
                 [
                    'attribute' => 'class',
                    'format' => 'raw',
                    'filter'=>ArrayHelper::map(CodesParam::find()->where(['type'=>'Product Class'])->asArray()->all(), 'id', 'title'),
                    'value' => function ($model) {
                        return isset($model->product_class)?$model->product_class->title:'';
                    },
                 ],
                 [
                    'attribute' => 'group',
                    'format' => 'raw',
                    'filter'=>ArrayHelper::map(CodesParam::find()->where(['type'=>'Product Group'])->asArray()->all(), 'id', 'title'),
                    'value' => function ($model) {
                        return isset($model->product_group)?$model->product_group->title:'';
                    },
                 ],
                   'model',
                   'style',
                   'origin',
                   'size',
                  [
                    'attribute' => 'sell_rate',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return number_format($model->sell_rate,3);
                    },
                 ],
                  [
                    'attribute' => 'cost_price',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return number_format($model->cost_price,3);
                    },
                 ],
                 [
                    'attribute' => 'created_at',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return date_format(date_create($model->created_at),"Y-m-d");
                    },
                 ],

                   
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
                    'format' => 'raw',
                    'value' => function ($model) {
                        return number_format($model->exchange_rate,3);
                    },
                  ],

                    [
                     'attribute' => 'status',
                     'format' => 'raw',
                     'label' => 'Status',
                     'filter'=>array("active"=>"Active","inactive"=>"Inactive","cancel"=>"Cancel"),
                     'value' => function ($model) {
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
                            return Html::a('<span class="btn btn-xs btn-primary" title="Update">Edit </span>', $url, ['target' => '_blank']);
                          },
                          'view' => function ($url,$model) {
                            $url =  $url;
                            return Html::a('<span class="btn btn-xs btn-info">Show </span>', $url, ['target' => '_blank']);
                          },
                        
                      ],
                  ],
              ],
          ]); ?>

          </div>

      </div>

    </div>

</div>

<?php Pjax::end(); ?>