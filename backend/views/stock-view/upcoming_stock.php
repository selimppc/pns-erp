<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $searchModel backend\models\ImGrnDetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $data;
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-header">

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=Url::base('')?>">Home</a></li>
        <li class="breadcrumb-item">Inventory</li>
                <li class="breadcrumb-item active"><?= Html::encode($this->title) ?></li>
      </ol>
     
      <div class="middle-menu-bar">
          <a href="#"><?=$data?></a>
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
              if(count($stock_list) > 0)
              {
                $count = 1;
                $total_quantity = 0;
            ?>
            
                  <table class="table table-striped table-bordered">
                
                    <thead>
                        <tr>
                          <th>No</th>
                          <th>Style</th>
                          <th>Item / Model</th>
                          <th>Product Name</th>
                          <th>Purchased Quantity</th>
                          <th>Sell Price</th>
                          <th>Cost Price</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php
                          foreach($stock_list as $values)
                          {
                            $total_quantity+=$values['quantity'];
                        ?>
                            <tr>
                                <td><?=$count?></td>
                                <td><?=$values['style']?></td>
                                <td><?=$values['model']?></td>
                                <td><?=$values['title']?></td>
                                <td><?=$values['quantity']?></td>
                                <td><?=number_format($values['sell_rate'],2)?></td>
                                <td><?=number_format($values['cost_price'],2)?></td>
                            </tr>

                        <?php
                          $count++;
                          }
                        ?>

                        <tr>
                            <td colspan="4" align="right">
                                Total quantity
                            </td>
                            <td colspan="3">
                              <?=$total_quantity?>
                            </td>
                        </tr>
                    </tbody>

                  </table>  

            <?php    
              }else{
                echo $data . ' not available';
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