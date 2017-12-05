<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ImAdjustHead */

$this->title = $model->transaction_no;
$this->params['breadcrumbs'][] = ['label' => 'Adjust Heads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-header">

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=Url::base('')?>">Home</a></li>
        <li class="breadcrumb-item">Inventory</li>
        <li class="breadcrumb-item"><a href="<?= Url::toRoute(['/stock-adjustment']); ?>">Stock Adjustment</a></li>
        <li class="breadcrumb-item active"><?= Html::encode($this->title) ?></li>
      </ol>
      
     
      <div class="middle-menu-bar">
        <?= Html::a(Yii::t('app', 'Create Stock Adjustment'), ['create'], ['class' => '']) ?>   
        <?= Html::a(Yii::t('app', 'Manage Stock Adjustment'), ['index'], ['class' => '']) ?> 
        <?= $model->status=='open'?Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'b']):''; ?> 

      
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
              Adjustment Details :: <?= Html::encode($this->title) ?>         
          </div>
      </div>


    <div class="panel-body">

        <table class="table table-striped table-bordered detail-view">

            <tr>
                <th>Date</th>
                <th>Confirm Date</th>
                <th>Branch</th>
                <th>Adjustment Type</th>
                <th>Currency</th>
                <th>Exchange Rate</th>                
                <th>Status</th>
            </tr>

            <tr>
                <td>
                    <?=$model->date?>
                </td>
                <td>
                    <?=$model->confirm_date?>
                </td>
                <td>
                    <?=isset($model->branch)?$model->branch->title:'';?>
                </td>
                <td>
                    <?=$model->type=='1'?'Positive':'Negative'?>
                </td>
                <td>
                    <?=isset($model->currency)?$model->currency->title:'';?>
                </td>
                <td>
                    <?=number_format($model->exchange_rate,3)?>
                </td>
                <td>
                    <?=$model->status?>
                </td>
            </tr>

        </table>

        <?php
            if(!empty($adjustment_details)){
        ?>

            <div class="panel panel-default">

                <div class="panel-heading" style="padding: 5px 10px">
                    <i class="fa fa-envelope"></i> Stock Adjustment Details                       
                </div>

                <table class="table table-striped table-bordered detail-view">

                    <tr>
                        <th>Product</th>
                        <th>Batch Number</th>
                        <th>Expire Date</th>                            
                        <th>Unit of Measurement</th> 
                        <th>Quantity</th>
                        <th>Stock Rate</th>
                    </tr>

                    <?php
                        foreach($adjustment_details as $adjustment){
                    ?>

                            <tr>
                                <td>
                                    <?=isset($adjustment->product)?$adjustment->product->title:''?>
                                </td>
                                <td>
                                    <?=$adjustment->batch_number?>
                                </td>
                                <td>
                                    <?=$adjustment->expire_date?>
                                </td>
                                <td>
                                    <?=isset($adjustment->uomData)?$adjustment->uomData->title:''?>
                                </td>
                                <td>
                                    <?=$adjustment->quantity?>
                                </td>
                                <td>
                                    <?=number_format($adjustment->stock_rate,3)?>
                                </td>
                            </tr>

                    <?php
                        }
                    ?>

                </table>    



            </div>
                    
        <?php
            }
        ?>

    </div>

</div> 