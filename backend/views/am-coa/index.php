<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
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
                    'account_code',
                    [
                      'attribute' => 'title',
                      'format' => 'raw',
                      'value' => function ($model) {
                          return Html::a($model->title, ['/am-coa/view', 'id' => $model->id]);
                      },
                    ],
                    'description:ntext',
                    'account_type',
                    'account_usage',
                    // 'group_one_id',
                    // 'group_two_id',
                    // 'group_three_id',
                    // 'group_four_id',
                    'analyical_code',
                    [
                      'attribute' => 'branch_id',
                      'label' => 'Branch',
                      'format' => 'raw',
                      'value' => function ($model) {
                          return isset($model->branch)?$model->branch->title:'';
                      },
                    ],
                    [
                        'label' => 'Status',
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