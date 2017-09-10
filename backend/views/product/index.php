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

        
         <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

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
             'model',
             'size',
             'origin',
             [
               'label' => 'Currency',
               'value' => function ($model) {
                   return isset($model->currency)?$model->currency->currency_code:'';
               }
             ],
            
             [
                'header' => 'Action',
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} ',
                'buttons' => [
                  'update' => function ($url,$model) {
                      $url =  $url;
                      return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, ['target' => '_blank']);
                    },
                    'view' => function ($url,$model) {
                      $url =  $url;
                      return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, ['target' => '_blank']);
                    },
                  
                ],
            ],
        ],
    ]); ?>


      </div>

    </div>

</div>

<?php Pjax::end(); ?>