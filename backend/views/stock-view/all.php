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
          <a href=""><?=$pageTitle?></a>
        <?php
          echo \yii\helpers\Html::a( '<i class="icon md-arrow-left" aria-hidden="true"></i> Back', Yii::$app->request->referrer,['class' => 'back']);
        ?>    
      </div>
</div>

<div class="page-content">

    <!-- Panel Basic -->
    <div class="panel">
       
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
                      <th>Style</th>
                      <th>Item / Model</th>
                      <th>Product Name</th>
                      <th>Totol Purchase </th>
                      <th>Branch</th>
                      <th>Purchase</th>
                      <th>Sell</th>
                      <th>Present Stock</th>
                      <th>Total Present Stock</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                      foreach($data as $values)
                      {
                    ?>
                        
                        <tr>
                            <td><?=$values['serial']?></td>
                            <td><?=$values['product_style']?></td>
                            <td><?=$values['product_model']?></td>
                            <td><?=$values['product_title']?></td>
                            <td>
                                <?php
                                  $total_purchase = 0;
                                  if(count($values['branch']))
                                  {
                                    foreach($values['branch'] as $branch_data)
                                    {
                                     $total_purchase+=$branch_data['total_purchase_qty'];
                                    }   
                                  }

                                  echo $total_purchase;
                                ?>
                            </td>
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