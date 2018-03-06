<?php
	use yii\helpers\Url;	
	use yii\helpers\Html;

	$this->title = Yii::t('app', 'Total Due');
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
                if(!empty($total_due))
                {
                  $total_qty = 0;
                  $total_sell_rate = 0;
                  $total_amount = 0;
              ?>
              
                    <table class="table table-striped table-bordered">

                        <thead>
                          <tr>
                            <th align="center">SL. No.</th>
                            <th align="center">Customer Name</th>
                            <th align="center">Sales Person</th>
                            <th align="center">Invoice No.</th>
                            <th align="center">Date</th>
                            <th align="center">Description</th>
                            <th align="center">Qty.</th>
                            <th align="center">Sell Rate</th>
                            <th align="center">Total</th>
                          </tr>
                      </thead>

                       <tbody>
                          <?php
                            foreach($total_due as $values)
                            {
                          ?>
                                <tr>
                                    <td align="center">
                                        <?=$values['serial']?>
                                    </td>
                                    <td align="center">
                                        <?=$values['customer_name']?>
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
                                                      <td><?=$order_data['sales_person_name']?></td>
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
                                                  $total_qty+=$order_data['quantity'];               
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
                                                  $total_sell_rate+=$order_data['rate'];              
                                              ?>
                                                  <tr>
                                                      <td><?=number_format($order_data['rate'],2)?></td>
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
                                                  $total_amount+=$order_data['row_amount'];
                                              ?>
                                                  <tr>
                                                      <td><?=number_format($order_data['row_amount'])?></td>
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
                              <td align="right" colspan="6">
                                  Total ::
                              </td>
                              <td align="center"><?=$total_qty?></td>
                              <td align="center"><?=number_format($total_sell_rate,2)?></td>
                              <td align="center"><?=number_format($total_amount,2)?></td>
                          </tr>

                        </tbody>

                    </table>

              <?php    
                }
              ?>

        	</div>

        </div>	


    </div>

</div>