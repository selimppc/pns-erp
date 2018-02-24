<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;

use yii\helpers\ArrayHelper;

use backend\models\SmInvoiceAllocation;
use backend\models\CodesParam;
use backend\models\Branch;


	$this->title = Yii::t('app', 'Money Recipt');
	$this->params['breadcrumbs'][] = $this->title;

?>

<div class="page-header">

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=Url::base('')?>">Home</a></li>
        <li class="breadcrumb-item active"><?=$this->title?></li>
      </ol>
     
      <div class="middle-menu-bar">

        <?= Html::a(Yii::t('app', 'Manage '.$this->title), ['index'], ['class' => '']) ?>   
        
        <?php
          echo \yii\helpers\Html::a( '<i class="icon md-arrow-left" aria-hidden="true"></i> Back', Yii::$app->request->referrer,['class' => 'back']);
        ?>    
      </div>
</div>

<div class="page-content">
    <!-- Panel Basic -->
    <div class="panel">

    	<?php 
            if(Yii::$app->session->hasFlash('success')){
        ?>
            <div class="alert alert-success">
              <?= Yii::$app->session->getFlash('success'); ?>
            </div>
        <?php 
            }
        ?>

        <?php 
            if(Yii::$app->session->hasFlash('error')){
        ?>
            <div class="alert alert-danger">
              <?= Yii::$app->session->getFlash('error'); ?>
            </div>
        <?php 
            }
        ?>


        <div id="flag_desc">
            <div id="flag_desc_text">
              <?php
                if(isset(\Yii::$app->params['manage_recipt_index']) && !empty(\Yii::$app->params['manage_recipt_index'])){
                  echo \Yii::$app->params['manage_recipt_index'];
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
                   
                    #'sm_head_id',
                    #'customer_id',
                    [
                      'attribute' => 'customer_code',
                      'format' => 'raw',
                      'value' => function ($model) {
                          return Html::a($model->customer_code, ['/money-recipt/create-money-receipt', 'sm_head_id' => $model->sm_head_id, 'customer_id' => $model->customer_id,'branch_id' => $model->branch_id]);
                      },
                   ],
                    'customer_name',
                    [
                        'attribute' => 'customer_group',
                        'label' => 'Customer Group',
                        'filter'=>ArrayHelper::map(CodesParam::find()->where(['type'=>'Customer Group'])->asArray()->all(), 'id', 'title'),
                        'format' => 'raw',
                        'value' => function ($model) {
                            return isset($model->customer_group_data)?$model->customer_group_data->title:'';
                        },
                    ],
                    [
                        'attribute' => 'branch_id',
                        'label' => 'Branch Id',
                        'filter'=>ArrayHelper::map(Branch::find()->asArray()->all(), 'id', 'title'),
                        'format' => 'raw',
                        'value' => function ($model) {
                            return isset($model->branch)?$model->branch->title:'';
                        },
                    ],
                    'customer_address',
                    'customer_cell',
                    'customer_phone',
                    'receivable_amount',
                    [
                        'header' => 'View Money Receipt',
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{view} ',
                        'buttons' => [
                          
                            'view' => function ($url,$model) {
                              $url =  ['money-recipt/show', 'sm_head_id' => $model->sm_head_id, 'customer_id' => $model->customer_id,'branch_id' => $model->branch_id ]; //$url
                              return Html::a('<span class="btn btn-xs btn-info">Show </span>', $url, ['target' => '_self']);
                            },
                          
                        ],
                    ],
                ],
            ]); ?>

          </div>

        </div>	


    </div>
</div>    