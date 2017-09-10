<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

use backend\models\ImGrnDetail;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ImGrnHeadSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Create GRN';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php Pjax::begin(); ?> 

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
        <?= Html::a(Yii::t('app', 'GRN History (PO Lists)'), ['/grn/grn-history'], ['class' => '']) ?>   
        <?= Html::a(Yii::t('app', 'Manage GRN'), ['/grn/manage-grn'], ['class' => '']) ?>   
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
                    if(isset(\Yii::$app->params['create_grn']) && !empty(\Yii::$app->params['create_grn'])){
                      echo \Yii::$app->params['create_grn'];
                    }
                ?>
            </div>
        </div>
       
        <div class="panel-body">

          <div class="form-width-35 pull-left">
          
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
                      <th>Product Code</th>
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

                        $already_added_grn = ImGrnDetail::grn_data($grn,$pp_details->product_id);

                        if(!empty($already_added_grn)){

                        if($pp_details->quantity > $already_added_grn->receive_quantity){

                          $orignal_quantity = $pp_details->quantity - $already_added_grn->receive_quantity;
                    ?>
                      <tr class="odd">
                          <td>
                            <?= Html::a(Yii::t('app', 'Manage '.isset($pp_details->product_code)?$pp_details->product_code:''), ['generate-grn','po'=>$po,'grn'=>$grn,'id'=>$pp_details->product_id], ['class' => '']) ?> 
                            
                          </td>
                          <td>
                              <?=$pp_details->title?>
                          </td>
                          <td><?=isset($pp_details->uomData)?$pp_details->uomData->title:'';?></td>
                          <td><?=$pp_details->uom_quantity?></td>
                          <td><?=$orignal_quantity?></td>
                          <td><?=number_format($pp_details->purchase_rate,2)?></td>
                          <td><?=number_format($pp_details->purchase_rate * $orignal_quantity,2)?></td>
                      </tr>

                    <?php                       
                          }
                        }else{
                    ?>
                    
                      <tr class="odd">
                          <td>
                            <?= Html::a(Yii::t('app', 'Manage '.isset($pp_details->product_code)?$pp_details->product_code:''), ['generate-grn','po'=>$po,'grn'=>$grn,'id'=>$pp_details->product_id], ['class' => '']) ?> 
                            
                          </td>
                          <td>
                              <?=$pp_details->title?>
                          </td>
                          <td><?=isset($pp_details->uomData)?$pp_details->uomData->title:'';?></td>
                          <td><?=$pp_details->uom_quantity?></td>
                          <td><?=$pp_details->quantity?></td>
                          <td><?=number_format($pp_details->purchase_rate,2)?></td>
                          <td><?=number_format($pp_details->purchase_rate * $pp_details->purchase_rate,2)?></td>
                      </tr>

                    <?php      
                        }
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
                      <td><?=number_format($details->cost_price,3)?></td>
                      <td><?=isset($details->productUom)?$details->productUom->title:'';?></td>
                      <td><?=number_format($details->row_amount,3)?></td>
                      <td>
                        <?=Html::a('<span class="glyphicon glyphicon-trash" title="Delete"></span>', ['grn/delete-grn','po'=>$po,'grn' => $grn ,'id' => $details->id], ["class"=>"btn btn-xs btn-danger","data-pjax" => 0, 'onClick' => 'return confirm("Are you sure you want to cancel this purchased order?") '])?>
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

<?php Pjax::end(); ?>