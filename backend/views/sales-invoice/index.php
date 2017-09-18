<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SmHeadSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Invoice Entry';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-header">

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=Url::base('')?>">Home</a></li>
        <li class="breadcrumb-item">Sales</li>

        <li class="breadcrumb-item active"><a href="<?= Url::toRoute(['/sales-invoice']); ?>"><?= Html::encode($this->title) ?></a></li>
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
                if(isset(\Yii::$app->params['invoice_entry_index']) && !empty(\Yii::$app->params['invoice_entry_index'])){
                  echo \Yii::$app->params['invoice_entry_index'];
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
                   # ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'sm_number',
                    'date',
                    'customer_id',
                    'branch_id',
                    'doc_type',
                    'prime_amount',
                    'tax_amount',
                    'discount_amount',
                    'net_amount',
                    'status',   
                    'gl_voucher_number',
                    [
                      'header' => 'Cancel Invoice',
                      'class' => 'yii\grid\ActionColumn',
                      'template' => '{cancel}',
                      'buttons' => [
                          'cancel' => function ($url, $model) {
                                return $model->status == 'confirmed'?Html::a('Cancel', ['sales-invoice/cancel', 'id' => $model->id], ['class' => 'btn btn-xs btn-danger', "data-pjax" => 0, 'onClick' => 'return confirm("Are you sure you want to cancel this invoice?") ']):'';
                            },
                    ],

                  ],                 
                  [
                      'header' => 'Confirm Invoice',
                      'class' => 'yii\grid\ActionColumn',
                      'template' => '{confirm}',
                      'buttons' => [
                          'cancel' => function ($url, $model) {
                                return $model->status == 'confirmed'?Html::a('Cancel', ['sales-invoice/confirm', 'id' => $model->id], ['class' => 'btn btn-xs btn-primary', "data-pjax" => 0, 'onClick' => 'return confirm("Are you sure you want to confirm this invoice?") ']):'';
                            },
                    ],
                    
                  ],

                ],


            ]); ?>

        </div>

      </div>  

    </div>
</div>    
