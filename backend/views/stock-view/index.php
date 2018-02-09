<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

use yii\helpers\ArrayHelper;

use backend\models\Branch;
use backend\models\CodesParam;

use backend\models\VwImStockView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ImGrnDetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Stock View';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-header">

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=Url::base('')?>">Home</a></li>
        <li class="breadcrumb-item">Inventory</li>
                <li class="breadcrumb-item active"><?= Html::encode($this->title) ?></li>
      </ol>
     
      <div class="middle-menu-bar">
          
        <?php
          echo \yii\helpers\Html::a( '<i class="icon md-arrow-left" aria-hidden="true"></i> Back', Yii::$app->request->referrer,['class' => 'back']);
        ?>    
      </div>
</div>

<div class="page-content">


    <div class="row mt-20" data-plugin="matchHeight" data-by-row="true">

        <div class="col-xl-4 col-md-4">
          <!-- Widget Linearea One-->
          <div class="card card-shadow" id="widgetLineareaOne">
            <div class="card-block p-20 pt-10" style="background: #63c2de;">
              <div class="clearfix">
                <div class="white float-left py-10">
                  <i class="icon md-chart white font-size-24 vertical-align-bottom mr-5"></i>     Dhaka
                </div>
                <span class="float-right white font-size-30"><?=$dhaka_branch_qty?></span>
              </div>
              <div class="mb-20 white">
                <i class="icon md-long-arrow-up white font-size-16"></i> Stock of Dhaka
              </div>
              
            </div>
          </div>
          <!-- End Widget Linearea One -->
        </div>

        <div class="col-xl-4 col-md-4">
          <!-- Widget Linearea One-->
          <div class="card card-shadow" id="widgetLineareaOne">
            <div class="card-block p-20 pt-10" style="background: #20a8d8;">
              <div class="clearfix">
                <div class="white float-left py-10">
                  <i class="icon md-chart white font-size-24 vertical-align-bottom mr-5"></i> Savar
                </div>
                <span class="float-right white font-size-30"><?=$savar_branch_qty?></span>
              </div>
              <div class="mb-20 white">
                <i class="icon md-long-arrow-up white font-size-16"></i>
                Stock of Savar
              </div>
              
            </div>
          </div>
          <!-- End Widget Linearea One -->
        </div>

        <div class="col-xl-4 col-md-4">
          <!-- Widget Linearea One-->
          <div class="card card-shadow" id="widgetLineareaOne">
            <div class="card-block p-20 pt-10" style="background: #ffc107;">
              <div class="clearfix">
                <div class="white float-left py-10">
                  <i class="icon md-chart white font-size-24 vertical-align-bottom mr-5"></i> Upcoming Quantity
                </div>
                <span class="float-right white font-size-30"><?=$po_approved_qty?></span>
              </div>
              <div class="mb-20 white">
                <i class="icon md-long-arrow-up white font-size-16"></i>
                Approved purchased
              </div>
              
            </div>
          </div>
          <!-- End Widget Linearea One -->
        </div>

    </div>

    <!-- Panel Basic -->
    <div class="panel">
        <!-- <div id="flag_desc">
          <div id="flag_desc_text">
              <?php
                if(isset(\Yii::$app->params['stock_view']) && !empty(\Yii::$app->params['stock_view'])){
                  echo \Yii::$app->params['stock_view'];
                }
              ?>              
          </div>
        </div> -->

      <div class="panel-body">

        

        <div class="table-responsive">

          
          <?php
            if(!empty($data))
            {
          ?>
          
              <table class="table table-striped table-bordered">
                
                <thead>
                    <tr>
                      <th>No</th>
                      <th>Item / Model</th>
                      <th>Sell Rate</th>
                      <th>Branch</th>
                      <th>Total Purchased Qty</th>
                      <th>Sale Qty</th>
                      <th>Available Qty</th>
                      <th>Total</th>
                      <th>Product Name</th>
                      <th>Style</th>
                      <th>UOM</th>
                      <th>Description</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                      foreach($data as $values)
                      {
                    ?>
                        
                        <tr>
                            <td><?=$values['serial']?></td>
                            <td><?=$values['product_model']?></td>
                            <td><?=number_format($values['sell_rate'],3)?></td>
                            <td style="padding: 0;border:0;">
                              <table style="width: 100%;height:100%;min-height:100%;text-align: center;">
                                <?php
                                  if(count($values['branch']))
                                  {
                                    foreach($values['branch'] as $branch_data)
                                    {
                                  ?>
                                      <tr>
                                          <td><?=$branch_data['branch_name']?></td>
                                      </tr>
                                  <?php    
                                    }   
                                  }
                                ?>
                              </table>
                            </td>

                            <td style="padding: 0;border:0;">
                              <table style="width: 100%;height:100%;text-align: center;">
                                <?php
                                  if(count($values['branch']))
                                  {
                                    foreach($values['branch'] as $branch_data)
                                    {
                                  ?>
                                      <tr>
                                          <td><?=$branch_data['total_purchase_qty']?></td>
                                      </tr>
                                  <?php    
                                    }   
                                  }
                                ?>
                              </table>
                            </td>

                            <td style="padding: 0;border:0;">
                              <table style="width: 100%;height:100%;text-align: center;">
                                <?php
                                  if(count($values['branch']))
                                  {
                                    foreach($values['branch'] as $branch_data)
                                    {
                                  ?>
                                      <tr>
                                          <td><?=$branch_data['sales_qty']?></td>
                                      </tr>
                                  <?php    
                                    }   
                                  }
                                ?>
                              </table>
                            </td>

                            <td style="padding: 0;border:0;">
                              <table style="width: 100%;height:100%;text-align: center;">                                <?php
                                  if(count($values['branch']))
                                  {
                                    foreach($values['branch'] as $branch_data)
                                    {
                                  ?>
                                      <tr>
                                          <td><?=$branch_data['available_qty']?></td>
                                      </tr>
                                  <?php    
                                    }   
                                  }
                                ?>
                              </table>
                            </td>

                            <td><?=$values['total_qty']?></td>
                            <td><?=$values['product_title']?></td>
                            <td><?=$values['product_style']?></td>
                            <td><?=$values['product_uom']?></td>
                            <td><?=$values['product_description']?></td>

                        </tr>

                    <?php    
                      }
                    ?>
                </tbody>

              </table>

          <?php    
            }
          ?>
           

        </div>
          
      </div>

    </div>
    
</div>     
<style type="text/css">
    b{
        font-weight: 700;
    }

    .table tr td{
      height: 70px;
    }
</style>