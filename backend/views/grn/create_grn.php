<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ImGrnHeadSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Create GRN';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="page-header">

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=Url::base('')?>">Home</a></li>
        <li class="breadcrumb-item">Inventory</li>
        <li class="breadcrumb-item">
        	<a href="<?= Url::toRoute(['/grn/grn-history']); ?>">
        		GRN
        	</a>
        </li>
        <li class="breadcrumb-item active"><?= Html::encode($this->title) ?></li>
      </ol>
     
      <div class="middle-menu-bar">
        <?= Html::a(Yii::t('app', 'GRN History'), ['/grn/grn-history'], ['class' => '']) ?>   
        <?= Html::a(Yii::t('app', 'Manage GRN'), ['/grn/manage-grn'], ['class' => '']) ?>   
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

          <div class="form-width-30 pull-left">
          
            <?= $this->render('/im-grn-detail/_form', [
                  'model' => $model,
              ]) ?>

          </div>

          <div class="form-width-60 pull-right grid-view">

            <h1>Purchase # <?=$po?> and Details</h1>

            <?php
              if(!empty($purchased_order_details))
              {
            ?>

              <table class="items">
                  <thead>
                    <tr>
                      <th>Product Name</th>
                      <th>Unit of Measurement</th>
                      <th>UOM Quantity</th>
                      <th>Quantity</th>
                      <th>Purchase Rate</th>
                      <th>Total Amount</th>
                    </tr>
                  </thead>

                  <tbody>
                    <?php
                      foreach($purchased_order_details as $pp_details)
                      {
                    ?>
                      <tr class="odd">
                          <td>
                            <?= Html::a(Yii::t('app', 'Manage '.isset($pp_details->product)?$pp_details->product->title:''), ['create-grn','po'=>$po,'grn'=>$grn,'id'=>$pp_details->id], ['class' => '']) ?> 
                            
                            </td>
                          <td><?=isset($pp_details->uomData)?$pp_details->uomData->title:'';?></td>
                          <td><?=$pp_details->uom_quantity?></td>
                          <td><?=$pp_details->quantity?></td>
                          <td><?=number_format($pp_details->purchase_rate,2)?></td>
                          <td><?=number_format($pp_details->purchase_rate * $pp_details->purchase_rate,2)?></td>
                      </tr>

                    <?php                       
                      }
                    ?>
                  </tbody>
              </table>

            <?php              
              }
            ?>


            <h2>GRN Detail :: <?=$grn?></h2>
            <table class="items">
              <thead>
                <tr>
                  <th>Product Name</th>
                  <th>Expiry Date</th>
                  <th>Receive Quantity</th>
                  <th>Cost Price</th>
                  <th>UOM</th>
                  <th>Total Value</th>
                  <th>Action</th>
                </tr>
              </thead>

              <tbody>
                <?php
                  if(!empty($grn_details)){
                  foreach($grn_details as $details){

                ?>
                    <tr>
                      <td>
                        <?=isset($details->product)?$details->product->title:''?>
                      </td>
                      <td><?=$details->expire_date?></td>
                      <td><?=$details->receive_quantity?></td>
                      <td><?=number_format($details->cost_price,2)?></td>
                      <td><?=isset($details->productUom)?$details->productUom->title:'';?></td>
                      <td><?=number_format($details->row_amount,2)?></td>
                      <td>
                        <?=Html::a('<span class="glyphicon glyphicon-trash" title="Delete"></span>', ['grn/delete-grn','po'=>$po,'grn' => $grn ,'id' => $details->id], ["data-pjax" => 0, 'onClick' => 'return confirm("Are you sure you want to cancel this purchased order?") '])?>
                      </td>
                    </tr>
                <?php 
                    }
                  }
                ?>
              </tbody>
            </table>

          </div>

        </div>

      </div>
</div>        