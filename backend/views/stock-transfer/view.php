<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ImTransferHead */

$this->title = $model->transfer_number;
$this->params['breadcrumbs'][] = ['label' => 'Stock Transfer', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-header">

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=Url::base('')?>">Home</a></li>
        <li class="breadcrumb-item">Inventory</li>
        <li class="breadcrumb-item"><a href="<?= Url::toRoute(['/stock-transfer']); ?>">Stock Transfer</a></li>
        <li class="breadcrumb-item active"><?= Html::encode($this->title) ?></li>
      </ol>
      
     
      <div class="middle-menu-bar">
        <?= Html::a(Yii::t('app', 'Add New Stock Transfer'), ['create'], ['class' => '']) ?>
        <?= Html::a(Yii::t('app', 'Manage Stock Transfer'), ['index'], ['class' => '']) ?> 

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
              Transfer Detail according to Transfer NO # <?=$model->transfer_number?>         
          </div>
      </div>
         
        <div class="panel-body">

            <table class="table table-striped table-bordered detail-view">
                <tr>
                    <th>Transfer Issue Date</th>
                    <th>Transfer Confirm Date</th>
                    <th>Note</th>
                    <th style="background-color: #ddd;border-bottom: 1px solid rgba(0, 0, 0, 0.06);border-right:1px solid rgba(0, 0, 0, 0.06);">From Branch</th>
                    <th style="background-color: #ddd;border-bottom: 1px solid rgba(0, 0, 0, 0.06);border-right: 1px solid rgba(0, 0, 0, 0.06);">From Currency</th>
                    <th style="background-color: #ddd;border-bottom: 1px solid rgba(0, 0, 0, 0.06);">From Exch. Rate</th>
                    <th style="background: #eee;">To Branch</th>
                    <th style="background: #eee;">To Currency</th>
                    <th style="background: #eee;">To Exch. Rate</th>
                    <th>Status</th>
                </tr>

                <tr>
                    <td><?=$model->date?></td>
                    <td><?=$model->confirm_date?></td>
                    <td><?=$model->note?></td>
                    <td style="background-color: #ddd;border-right:1px solid rgba(0, 0, 0, 0.06);"><?=isset($model->fromBranch)?$model->fromBranch->title:''?></td>
                    <td style="background-color: #ddd;border-right:1px solid rgba(0, 0, 0, 0.06);"><?=isset($model->fromCurrency)?$model->fromCurrency->title:''?></td>
                    <td style="background-color: #ddd;"><?=number_format($model->from_exchange_rate,3)?></td>
                    <td style="background: #eee;"><?=isset($model->toBranch)?$model->toBranch->title:''?></td>
                    <td style="background: #eee;"><?=isset($model->toCurrency)?$model->toCurrency->title:''?></td>
                    <td style="background: #eee;"><?=number_format($model->to_exchange_rate,3)?></td>
                    <td><?=$model->status?></td>
                </tr>
            </table>


            <?php
                if(!empty($transfer_details)){
            ?>

                <div class="panel panel-default">

                    <div class="panel-heading" style="padding: 5px 10px">
                        <i class="fa fa-envelope"></i> Stock Transfer Details                       
                    </div>

                    <table class="table table-striped table-bordered detail-view">

                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Unit of Measurment</th>                            
                            <th>Purchased Rate</th> 
                        </tr>

                        <?php
                            foreach($transfer_details as $transfer){
                        ?>
                                
                                <tr>
                                    <td>
                                        <?=isset($transfer->product)?$transfer->product->title:''?>
                                    </td>
                                    <td>
                                        <?=$transfer->quantity?>
                                    </td>
                                    <td>
                                        <?=isset($transfer->uomData)?$transfer->uomData->title:''?>
                                    </td>
                                    <td>
                                        <?=$transfer->rate?>
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
</div>        
