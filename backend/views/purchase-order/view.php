<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model backend\models\PpPurchaseHead */

$this->title = $model->po_order_number;
$this->params['breadcrumbs'][] = ['label' => 'Purchase Order', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php Pjax::begin(); ?> 
<div class="page-header">

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=Url::base('')?>">Home</a></li>
        <li class="breadcrumb-item">Purchase</li>
        <li class="breadcrumb-item"><a href="<?= Url::toRoute(['/pp-purchase-head']); ?>">Purchase Order</a></li>
        <li class="breadcrumb-item active"><?= Html::encode($this->title) ?></li>
      </ol>
      
     
      <div class="middle-menu-bar">
        <?= Html::a(Yii::t('app', 'Create Purchase Order'), ['create'], ['class' => '']) ?>   
        <?= Html::a(Yii::t('app', 'Manage Purchase Order'), ['index'], ['class' => '']) ?> 

        <?php 
            if($model->status == 'open')
            {
        ?>
            <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'b']) ?>

            <?= Html::a(Yii::t('app', 'Approved'), ['approved', 'id' => $model->id], ['class' => 'b',"data-pjax" => 0, 'onClick' => 'return confirm("Are you sure you want to approved this purchased order?") ']) ?>

            <?= Html::a(Yii::t('app', 'Cancel'), ['cancel', 'id' => $model->id], ['class' => 'b',"data-pjax" => 0, 'onClick' => 'return confirm("Are you sure you want to cancel this purchased order?") ']) ?>

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
              <?php
                if(isset(\Yii::$app->params['purchase_order_view']) && !empty(\Yii::$app->params['purchase_order_view'])){
                  echo \Yii::$app->params['purchase_order_view'];
                }
              ?>              
          </div>
      </div>
         
        <div class="panel-body">

            <table class="table table-striped table-bordered detail-view">
               
                <tr>
                    <th>Purchase Order No</th>
                    <th>Date</th>
                    <th>Supplier</th>
                    <th>Payment Terms</th>
                    <th>Delivery Date</th>
                    <th>Branch</th>
                    <th>Currency</th>
                    <th>Exchange Rate</th>
                    <th>Discount Rate</th>
                    <th>Status</th>
                </tr>

                <tr>
                    <td><?=$model->po_order_number?></td>
                    <td><?=$model->date?></td>
                    <td><?=isset($model->supplier)?$model->supplier->supplier_code:''?></td>
                    <td><?=$model->pay_terms?></td>
                    <td><?=$model->delivery_date?></td>
                    <td><?=isset($model->branch)?$model->branch->title:''?></td>
                    <td><?=isset($model->currency)?$model->currency->currency_code:''?></td>
                    <td><?=$model->exchange_rate?></td>
                    <td><?=$model->discount_rate?></td>
                    <td><?=ucfirst($model->status)?></td>
                </tr>
                
            </table>

            <?php
                if(!empty($purchased_order_details))
                {
            ?>
                <div class="panel panel-default">
                    <div class="panel-heading" style="padding: 5px 10px">
                        <i class="fa fa-envelope"></i> Purchase Order Details
                       
                    </div>

                    <table class="table table-striped table-bordered detail-view">
                        
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Unit of Measurment</th>
                            <th>UOM Quantity</th>
                            <th>Purchased Rate</th> 
                            <th>Line Total</th>   
                        </tr>

                        <?php
                            foreach($purchased_order_details as $po_details)
                            {
                        ?>
                                <tr>
                                    <td>
                                        <?=isset($po_details->product)?$po_details->product->title:'';?>
                                            
                                    </td>

                                    <td>
                                        <?=$po_details->quantity?>
                                            
                                    </td>

                                    <td>
                                        <?=isset($po_details->uomData)?$po_details->uomData->title:''?>
                                            
                                    </td>

                                    <td>
                                        <?=$po_details->uom_quantity?>
                                            
                                    </td>

                                    <td>
                                        <?=number_format($po_details->purchase_rate,2)?>
                                            
                                    </td>

                                    <td>
                                        <?=number_format($po_details->purchase_rate*$po_details->quantity,2)?>
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
<?php Pjax::end(); ?>