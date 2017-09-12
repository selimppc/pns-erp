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

      <header class="panel-heading">
        <div class="panel-actions"></div>
        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
      </header>
     
      <div class="panel-body">

      <div class="table-responsive">

        <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'transfer_number',
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
            'status',

            [
                'header' => 'Action',
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} ',
                'buttons' => [
                  'update' => function ($url,$model) {
                      $url =  $url;
                      return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, ['target' => '_self']);
                    },
                    'view' => function ($url,$model) {
                      $url =  $url;
                      return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, ['target' => '_self']);
                    },
                  
                ],
            ],
        ],
    ]); ?>

      </div>
      </div>

    </div> 
</div>    
