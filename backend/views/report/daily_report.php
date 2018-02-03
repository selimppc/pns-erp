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
          
        <?php
          echo \yii\helpers\Html::a( '<i class="icon md-arrow-left" aria-hidden="true"></i> Back', Yii::$app->request->referrer,['class' => 'back']);
        ?>    
      </div>
</div>


<div class="page-content">


    <div class="row mt-20" data-plugin="matchHeight" data-by-row="true">

        <?= $this->render('//sales-invoice/_sales_summary',[
          'todays_sale' => $todays_sale,
          'this_month_sale' => $this_month_sale,
          'all_sales' => $all_sales
      ]); ?>

    </div>


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
		                      <th>Item / Model</th>
		                      <th style="text-align: center;">Branch</th>
		                      <th style="text-align: center;">Sales Qty</th>
		                      <th style="text-align: right;">Total Amount</th>
		                      <th style="text-align: right;">Discount Amount</th>
		                      <th style="text-align: right;">Net Amount</th>
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
                            			<table style="width: 100%;height:100%;min-height:100%;text-align: center;">
                            				<?php
			                                  if(count($values['branch']))
			                                  {
			                                    foreach($values['branch'] as $branch_data)
			                                    {
			                                  ?>
			                                      <tr>
			                                          <td><?=$branch_data['total_qty']?></td>
			                                      </tr>
			                                  <?php    
			                                    }   
			                                  }
			                                ?>
                            			</table>
                            		</td>

                            		<td style="padding: 0;border:0;">
                            			<table style="width: 100%;height:100%;min-height:100%;text-align: right;">
                            				<?php
			                                  if(count($values['branch']))
			                                  {
			                                    foreach($values['branch'] as $branch_data)
			                                    {
			                                  ?>
			                                      <tr>
			                                          <td><?=number_format($branch_data['total_amount'],2)?></td>
			                                      </tr>
			                                  <?php    
			                                    }   
			                                  }
			                                ?>
                            			</table>
                            		</td>


                            		<td style="padding: 0;border:0;">
                            			<table style="width: 100%;height:100%;min-height:100%;text-align: right;">
                            				<?php
			                                  if(count($values['branch']))
			                                  {
			                                    foreach($values['branch'] as $branch_data)
			                                    {
			                                  ?>
			                                      <tr>
			                                          <td><?=number_format($branch_data['discount_amount'],2)?></td>
			                                      </tr>
			                                  <?php    
			                                    }   
			                                  }
			                                ?>
                            			</table>
                            		</td>

                            		<td style="padding: 0;border:0;">
                            			<table style="width: 100%;height:100%;min-height:100%;text-align: right;">
                            				<?php
			                                  if(count($values['branch']))
			                                  {
			                                    foreach($values['branch'] as $branch_data)
			                                    {
			                                  ?>
			                                      <tr>
			                                          <td><?=number_format($branch_data['net_amount'],2)?></td>
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