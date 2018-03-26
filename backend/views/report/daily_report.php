<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

use yii\helpers\ArrayHelper;

$this->title = $title;
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="page-header">

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=Url::base('')?>">Home</a></li>
        <li class="breadcrumb-item">Report</li>
                <li class="breadcrumb-item active"><?= Html::encode($this->title) ?></li>
      </ol>
     
      <div class="middle-menu-bar">

      	<a class="white"><?=isset($label)?$label:'';?></a>
          
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

	            		$total_qty = 0;
	            		$total_sell_rate = 0;
	            		$total_sub_total = 0;
	            		$total_discount_value = 0;
	            		$total_value = 0;
	          	?>

	          		<table class="table table-striped table-bordered">

		          		<thead>
		                    <tr>
		                      <th>SL. No.</th>
		                      <th>Sales Person</th>
		                      <th>Customer Name</th>
		                      <th>Invoice No.</th>
		                      <th>Date</th>
		                      <th>Product Model</th>
		                      <th>Qty.</th>
		                      <th>Sell Rate</th>
		                      <th>Sub Total</th>
		                      <th>Discount</th>
		                      <th>Total</th>
		                    </tr>
		                </thead>

		                <tbody>
		                    <?php
		                      foreach($data as $values)
		                      {
		                    ?>

		                    	<tr>
		                    		<td><?=$values['serial']?></td>
		                    		<td><?=$values['sales_person_name']?></td>	
		                    		<td style="padding: 0;border:0;">
                            			<table style="width: 100%;height:100%;min-height:100%;text-align: center;">
                            				<?php
			                                  if(count($values['order_list']))
			                                  {
			                                    foreach($values['order_list'] as $order_data)
			                                    {
			                                  ?>
			                                      <tr>
			                                          <td><?=$order_data['customer_name']?></td>
			                                      </tr>
			                                  <?php    
			                                    }   
			                                  }
			                                ?>
                            			</table>
                            		</td>
                            		<td style="padding: 0;border:0;">
                            			<table style="width: 100%;height:100%;min-height:100%;text-align: center;">
                            				<?php
			                                  if(count($values['order_list']))
			                                  {
			                                    foreach($values['order_list'] as $order_data)
			                                    {
			                                  ?>
			                                      <tr>
			                                          <td><?=$order_data['sm_number']?></td>
			                                      </tr>
			                                  <?php    
			                                    }   
			                                  }
			                                ?>
                            			</table>
                            		</td>
                            		<td style="padding: 0;border:0;">
                            			<table style="width: 100%;height:100%;min-height:100%;text-align: center;">
                            				<?php
			                                  if(count($values['order_list']))
			                                  {
			                                    foreach($values['order_list'] as $order_data)
			                                    {
			                                  ?>
			                                      <tr>
			                                          <td><?=$order_data['date']?></td>
			                                      </tr>
			                                  <?php    
			                                    }   
			                                  }
			                                ?>
                            			</table>
                            		</td>
                            		<td style="padding: 0;border:0;">
                            			<table style="width: 100%;height:100%;min-height:100%;text-align: center;">
                            				<?php
			                                  if(count($values['order_list']))
			                                  {
			                                    foreach($values['order_list'] as $order_data)
			                                    {
			                                  ?>
			                                      <tr>
			                                          <td><?=$order_data['product_model']?></td>
			                                      </tr>
			                                  <?php    
			                                    }   
			                                  }
			                                ?>
                            			</table>
                            		</td>
                            		<td style="padding: 0;border:0;">
                            			<table style="width: 100%;height:100%;min-height:100%;text-align: center;">
                            				<?php
			                                  if(count($values['order_list']))
			                                  {
			                                    foreach($values['order_list'] as $order_data)
			                                    {
			                                    	$total_qty +=$order_data['quantity'];
			                                  ?>
			                                      <tr>
			                                          <td><?=$order_data['quantity']?></td>
			                                      </tr>
			                                  <?php    
			                                    }   
			                                  }
			                                ?>
                            			</table>
                            		</td>

                            		<td style="padding: 0;border:0;">
                            			<table style="width: 100%;height:100%;min-height:100%;text-align: center;">
                            				<?php
			                                  if(count($values['order_list']))
			                                  {
			                                    foreach($values['order_list'] as $order_data)
			                                    {
			                                    	$total_sell_rate +=$order_data['sell_rate'];
			                                  ?>
			                                      <tr>
			                                          <td><?=number_format($order_data['sell_rate'],2)?></td>
			                                      </tr>
			                                  <?php    
			                                    }   
			                                  }
			                                ?>
                            			</table>
                            		</td>
                            		<td style="padding: 0;border:0;">
                            			<table style="width: 100%;height:100%;min-height:100%;text-align: center;">
                            				<?php
			                                  if(count($values['order_list']))
			                                  {
			                                    foreach($values['order_list'] as $order_data)
			                                    {
			                                    	$total_sub_total +=$order_data['sub_total'];
			                                  ?>
			                                      <tr>
			                                          <td><?=number_format($order_data['sub_total'],2)?></td>
			                                      </tr>
			                                  <?php    
			                                    }   
			                                  }
			                                ?>
                            			</table>
                            		</td>

                            		<td style="padding: 0;border:0;">
                            			<table style="width: 100%;height:100%;min-height:100%;text-align: center;">
                            				<?php
			                                  if(count($values['order_list']))
			                                  {
			                                    foreach($values['order_list'] as $order_data)
			                                    {
			                                    	$total_discount_value +=$order_data['total_discount'];
			                                  ?>
			                                      <tr>
			                                          <td><?=number_format($order_data['total_discount'],2)?></td>
			                                      </tr>
			                                  <?php    
			                                    }   
			                                  }
			                                ?>
                            			</table>
                            		</td>

                            		<td style="padding: 0;border:0;">
                            			<table style="width: 100%;height:100%;min-height:100%;text-align: center;">
                            				<?php
			                                  if(count($values['order_list']))
			                                  {
			                                    foreach($values['order_list'] as $order_data)
			                                    {
			                                    	$total_value +=$order_data['total_amount'];
			                                  ?>
			                                      <tr>
			                                          <td><?=number_format($order_data['total_amount'],2)?></td>
			                                      </tr>
			                                  <?php    
			                                    }   
			                                  }
			                                ?>
                            			</table>
                            		</td>
		                    	</tr>

		                    <?php
		                    	}
		                    ?>
		                    <tr>
		                    	<td colspan="6">
		                    		<b>Total</b>
		                    	</td>
		                    	<td><?=$total_qty?></td>
		                    	<td><?=number_format($total_sell_rate,2)?></td>
		                    	<td><?=number_format($total_sub_total,2)?></td>
		                    	<td><?=number_format($total_discount_value,2)?></td>
		                    	<td><?=number_format($total_value,2)?></td>
		                    </tr>
		                </tbody>    
	          		</table>


	          	<?php
	          		}else{
	          			echo 'No sales at this moment';
	          		}
	          	?>

        	</div>

        </div>	


    </div>

</div>

<style type="text/css">
	.table-bordered thead th
	{
		text-align: center;
	}

	.table-bordered tbody td
	{
		text-align: center;
		padding-bottom: 0;
	}

	b{
        font-weight: 700;
    }

    .table tr td{
      height: 50px;
    }
</style>