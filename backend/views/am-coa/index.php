<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;

use yii\helpers\ArrayHelper;

use backend\models\GroupOne;
use backend\models\GroupTwo;
use backend\models\Branch;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AmCoaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Chart of Account');
$this->params['breadcrumbs'][] = $this->title;
?>
<?php Pjax::begin(); ?> 
<div class="page-header">

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=Url::base('')?>">Home</a></li>
        <li class="breadcrumb-item">General Ledger</li>
        <li class="breadcrumb-item active"><?= Html::encode($this->title) ?></li>
      </ol>
     
      <div class="middle-menu-bar">
        <?= Html::a(Yii::t('app', 'Add New Chart of Account'), ['create'], ['class' => '']) ?>
        <?= Html::a(Yii::t('app', 'Manage Chart of Account'), ['index'], ['class' => '']) ?>   
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
                  if(isset(\Yii::$app->params['am_coa_index']) && !empty(\Yii::$app->params['am_coa_index'])){
                    echo \Yii::$app->params['am_coa_index'];
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
                      'attribute' => 'group_one_id',
                      'format' => 'raw',
                      'filter'=>ArrayHelper::map(GroupOne::find()->asArray()->all(), 'id', 'title'),
                      'value' => function ($model) {
                          return isset($model->groupOne)?$model->groupOne->title:'';
                      },
                    ],
                    [
                      'attribute' => 'group_two_id',
                      'format' => 'raw',
                      'filter'=>ArrayHelper::map(GroupTwo::find()->asArray()->all(), 'id', 'title'),
                      'value' => function ($model) {
                          return isset($model->groupTwo)?$model->groupTwo->title:'';
                      },
                    ],
                    
                    'account_code',
                    [
                      'attribute' => 'title',
                      'format' => 'raw',
                      'value' => function ($model) {
                          return Html::a($model->title, ['/am-coa/view', 'id' => $model->id]);
                      },
                    ],
                    'description:ntext',
                    [
                      'attribute' => 'account_type',
                      'format' => 'raw',
                      'filter'=>array("Asset"=>"Asset","Liability"=>"Liability","Income"=>"Income", "Expenses" => "Expenses"),
                      'value' => function ($model) {
                          return $model->account_type;
                      },
                    ],

                    [
                      'attribute' => 'account_usage',
                      'format' => 'raw',
                      'filter'=>array("Ledger"=>"Ledger","AP"=>"AP","AR"=>"AR"),
                      'value' => function ($model) {
                          return $model->account_usage;
                      },
                    ],

                    [
                      'attribute' => 'analyical_code',
                      'format' => 'raw',
                      'filter'=>array("Cash"=>"Cash","Non-Cash"=>"Non-Cash","Cheque"=>"Cheque","Bankers Draft"=>"Bankers Draft","Wire Transfer"=>"Wire Transfer","Letter of Credit"=>"Letter of Credit","Others"=>"Others"),
                      'value' => function ($model) {
                          return $model->analyical_code;
                      },
                    ],                                       
                    
                    'analyical_code',
                    [
                      'attribute' => 'branch_id',
                      'label' => 'Branch',
                      'format' => 'raw',
                      'filter'=>ArrayHelper::map(Branch::find()->asArray()->all(), 'id', 'title'),
                      'value' => function ($model) {
                          return isset($model->branch)?$model->branch->title:'';
                      },
                    ],
                    [
                        'attribute' => 'status',
                        'label' => 'Status',
                        'filter'=>array("active"=>"Active","inactive"=>"Inactive","cancel"=>"Cancel"),
                        'value' => function ($model){
                            return ucfirst($model->status);
                        }
                    ],
                    // 'created_by',
                    // 'updated_by',
                    //'created_at',
                    // 'updated_at',

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
</div>   
<?php Pjax::end(); ?>