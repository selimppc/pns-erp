<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

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
    <!-- Panel Basic -->
    <div class="panel">

      <header class="panel-heading">
        <div class="panel-actions"></div>
        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
      </header>
     
      <div class="panel-body">

            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Product Code</th>
                  <th>Product Name</th>
                  <th>Batch Number</th>
                  <th>Expiry Date</th>
                  <th>Branch</th>
                  <th>Stock Rate</th>
                  <th>Unit</th>
                  <th>Transfer Quantity</th>
                  <th>Sell Quantity</th>
                  <th>Stock Quantity</th>
                  <th>Available Quantity</th>
                </tr>
              </thead>

              <tbody>
                  <?php
                    if(!empty($models)){
                      $count = 1;
                      foreach($models as $data){
                  ?>
                      <tr>
                        <td><?=$count?></td>
                        <td><?=$data->product_code?></td>
                        <td><?=$data->title?></td>
                        <td><?=$data->batch_number?></td>
                        <td><?=$data->date?></td>
                        <td><?=$data->branch_name?></td>
                        <td><?= number_format($data->cost_price, 3)?></td>
                        <td></td>
                        <td>0</td>
                        <td>0</td>
                        <td><?=$data->quantity?></td>
                        <td><?=$data->quantity?></td>
                      </tr>

                  <?php      
                    $count++;
                      }
                    }else{
                      echo 'Stock Not Available';
                    }
                  ?>
              </tbody>
            </table>

      </div>

    </div>
    
</div>     
