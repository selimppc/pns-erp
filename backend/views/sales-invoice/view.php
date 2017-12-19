<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model backend\models\SmHead */

$this->title = $model->sm_number;
$this->params['breadcrumbs'][] = ['label' => 'Sales Invoice', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-header">

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=Url::base('')?>">Home</a></li>
        <li class="breadcrumb-item">Sales</li>
        <li class="breadcrumb-item"><a href="<?= Url::toRoute(['/sales-invoice']); ?>">Invoice Entry</a></li>
        <li class="breadcrumb-item active"><?= Html::encode($this->title) ?></li>
      </ol>
      
     
      <div class="middle-menu-bar">
        <?= Html::a(Yii::t('app', 'Create Sales Invoice'), ['create'], ['class' => '']) ?>   
        <?= Html::a(Yii::t('app', 'Manage Sales Invoice'), ['index'], ['class' => '']) ?> 

        <?php 
            if($model->status == 'open')
            {
        ?>
            <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'b']) ?>

            <?= Html::a(Yii::t('app', 'Confirm'), ['confirm', 'id' => $model->id], ['class' => 'b',"data-pjax" => 0, 'onClick' => 'return confirm("Are you sure you want to approved this confirm?") ']) ?>
           
        <?php 
            }
        ?> 

         
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
              Invoice Details ::  <?=$model->sm_number?>            
          </div>
        </div>


        <div class="panel-body">

            <table class="table table-striped table-bordered detail-view">

                <tr>
                    <th>Sales Number</th>
                    <th>Sales Date</th>
                    <th>Branch</th>                    
                    <th>Customer Name</th>
                    <th>Sales Person</th>
                    <th>Discount</th>
                    <th>Pay Terms</th>
                    <th>Currency</th>
                    <th>Exchange Rate</th>                    
                </tr>

                <tr>

                    <?php
                        $commission = ($model->net_amount * $model->commission)/100;
                    ?>
                    <td><?=$model->sm_number?></td>
                    <td><?=$model->date?></td>
                    <td><?=isset($model->branch)?$model->branch->title:''?></td>
                    <td><?=isset($model->customer)?$model->customer->name:''?></td>
                    <td>
                        <?php
                            if(isset($model->salesperson))
                            {
                                echo $model->salesperson->name;
                                echo '<br/>Commission :: '.$model->salesperson->commission.'%('.$commission.')';
                            }
                        ?>
                    </td>
                    <td><?=$model->discount_amount?></td>
                    <td><?=ucfirst($model->doc_type)?></td>
                    <td><?=isset($model->currency)?$model->currency->currency_code:''?></td>
                    <td><?=number_format($model->exchange_rate,3)?></td>
                </tr>

            </table>

            <?php
                if(!empty($sm_details_r)){
            ?>
                <div class="panel panel-default">

                    <div class="panel-heading" style="padding: 5px 10px">
                        <i class="fa fa-envelope"></i> Item Details                       
                    </div>

                    <table class="table table-striped table-bordered detail-view">

                        <tr>
                            <th>Product Name</th>
                            <th>Product Code</th>
                            <th>Product Model</th>
                            <th>Sell Rate</th>
                            <th>Quantity</th>
                            <th>Unit of Measurment</th>                            
                            <th>Sub Total</th> 
                            <th>Discount</th>
                            <th>Total</th>   
                        </tr>

                        <?php
                            foreach($sm_details_r as $sm_details){
                        ?>

                            <tr>
                                <td>
                                    <?=isset($sm_details->product)?$sm_details->product->title:'';?>
                                </td>
                                <td>
                                    <?=isset($sm_details->product)?$sm_details->product->product_code:'';?>
                                </td>
                                <td>
                                    <?=isset($sm_details->product)?$sm_details->product->model:'';?>
                                </td>
                                <td>
                                    <?=number_format($sm_details->rate,3)?>
                                </td>
                                <td>
                                    <?=$sm_details->quantity?>
                                </td>
                                <td>
                                    <?=isset($sm_details->uomData)?$sm_details->uomData->title:''?>
                                        
                                </td>
                                <td>
                                    <?=number_format($sm_details->rate*$sm_details->quantity,3);?>
                                </td>
                                <td>
                                    <?=number_format($sm_details->total_discount,3);?>
                                </td>
                                <td>
                                    <?=number_format(($sm_details->rate*$sm_details->quantity)-$sm_details->total_discount,3);?>
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


            <div class="col-md-4 pull-right">
                <div class="row">
                    <div id="flag_desc">
                      <div id="flag_desc_text">
                          Break Down of Invoice Amount
                      </div>
                    </div>
                </div>

                <br/>
                <table class="table table-striped table-bordered detail-view">
                    <tr>
                        <td>Invoice Amount</td>
                        <td><?=number_format($model->prime_amount,3)?></td>
                    </tr>
                    <tr>
                        <td>Discount Rate (%)</td>
                        <td><?=number_format($model->discount_rate,3)?></td>
                    </tr>
                    <tr>
                        <td>Discount Amount</td>
                        <td><?=number_format($model->discount_amount,3)?></td>
                    </tr>
                    
                    <tr>
                        <td>Total Amount</td>
                        <td><?=number_format($model->net_amount,3)?></td>
                    </tr>
                </table>

            </div>

        </div>    

    </div>

</div>    

