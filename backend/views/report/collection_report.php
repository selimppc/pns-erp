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
        			if(!empty($data)){
        		?>
        		
        			<table class="table table-striped table-bordered">

		          		<thead>
		                    <tr>
		                      <th>SL. No.</th>
		                      <th>Customer Name</th>
		                      <th>Money Receipt</th>
		                      <th>Date</th>
		                      <th>Bank/Cash</th>
		                      <th>Cheque Number</th>
		                      <th>Invoice Number</th>
		                      <th>Note</th>
		                      <th>Total Amount</th>
		                    </tr>
		                </thead>

		                <tbody>

		                	<?php
		                	  $total_amount = 0;
		                      foreach($data as $values)
		                      {
		                    ?>
		                    		<tr>
		                    			<td><?=$values['serial']?></td>
		                    			<td><?=$values['customer_name']?></td>
		                    			<td style="padding: 0;border:0;">
	                            			<table style="width: 100%;height:100%;min-height:100%;text-align: center;">
	                            				<?php
				                                  if(count($values['order_list']))
				                                  {
				                                    foreach($values['order_list'] as $order_data)
				                                    {
				                                  ?>
				                                      <tr>
				                                          <td><?=$order_data['money_receipt']?></td>
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
				                                          <td><?=$order_data['bank_or_cash']?></td>
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
				                                          <td><?=$order_data['check_number']?></td>
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
				                                          <td><?=$order_data['invoice_number']?></td>
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
				                                          <td><?=$order_data['note']?></td>
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
				                                    	$total_amount+=$order_data['amount'];
				                                  ?>
				                                      <tr>
				                                          <td><?=number_format($order_data['amount'],2)?></td>
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
				                    	<td colspan="8">
				                    		<b>Total</b>
				                    	</td>
				                    	<td>
				                    		<?=number_format($total_amount,2);?>
				                    	</td>
				                    </tr>

		                </tbody>

		            </table>    

        		<?php		
        			}else{
        				echo 'No collection in this range';
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