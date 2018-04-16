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
                  $total_paid_amount = 0;
                  $total_due_amount = 0;
              ?>
              
                    <table class="table table-striped table-bordered" style="text-align: center;">

                        <thead>
                          <tr>
                            <th style="text-align: center;">SL. No.</th>
                            <th style="text-align: center;">Sales Person</th>
                            <th style="text-align: center;">Customer Name</th>
                            <th style="text-align: center;">Invoice No.</th>
                            <th style="text-align: center;">Note</th>
                            <th style="text-align: center;">Date</th>
                            <th style="text-align: center;">Item / Model</th>
                            <th style="text-align: center;">Total Sell Amount</th>
                            <th style="text-align: center;">Total Paid Amount</th>
                            <th style="text-align: center;">Total Due Amount</th>
                          </tr>
                      </thead>

                       <tbody>
                          <?php
                            foreach($total_due as $values)
                            {
                              $sub_total_sell_amount = 0;
                              $sub_total_paid_amount = 0;
                              $sub_total_due_amount = 0;
                          ?>
                                <tr>
                                    <td align="center">
                                        <?=$values['serial']?>
                                    </td>

                                    <td align="center">
                                        <?=$values['sales_person_name']?>
                                    </td>
                                    
                                    <td style="padding: 0;border:0;">
                                        <table style="width: 100%;height:100%;min-height:100%;text-align: center;">
                                          <?php
                                              if(count($values['due_customer_list']))
                                              {
                                                foreach($values['due_customer_list'] as $due_customer)
                                                {
                                              ?>
                                                  <tr>
                                                      <td><?=$due_customer['customer_name']?></td>
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
                                              if(count($values['due_customer_list']))
                                              {
                                                foreach($values['due_customer_list'] as $due_customer)
                                                {
                                              ?>
                                                  <tr>
                                                      <td><?=$due_customer['invoice_number']?></td>
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
                                              if(count($values['due_customer_list']))
                                              {
                                                foreach($values['due_customer_list'] as $due_customer)
                                                {
                                              ?>
                                                  <tr>
                                                      <td><?=$due_customer['note']?></td>
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
                                              if(count($values['due_customer_list']))
                                              {
                                                foreach($values['due_customer_list'] as $due_customer)
                                                {
                                              ?>
                                                  <tr>
                                                      <td><?=$due_customer['date']?></td>
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
                                              if(count($values['due_customer_list']))
                                              {
                                                foreach($values['due_customer_list'] as $due_customer)
                                                {
                                              ?>
                                                  <tr>
                                                      <td><?=$due_customer['model']?></td>
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
                                              if(count($values['due_customer_list']))
                                              {
                                                foreach($values['due_customer_list'] as $due_customer)
                                                {
                                                  $total_amount+=$due_customer['net_amount'];
                                                  $sub_total_sell_amount+=$due_customer['net_amount'];
                              
                                              ?>
                                                  <tr>
                                                      <td><?=number_format($due_customer['net_amount'], 2)?></td>
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
                                              if(count($values['due_customer_list']))
                                              {
                                                foreach($values['due_customer_list'] as $due_customer)
                                                {
                                                  $total_paid_amount+=$due_customer['paid_amount'];
                                                  $sub_total_paid_amount +=$due_customer['paid_amount'];
                              
                                              ?>
                                                  <tr>
                                                      <td><?=number_format($due_customer['paid_amount'],2)?></td>
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
                                              if(count($values['due_customer_list']))
                                              {
                                                foreach($values['due_customer_list'] as $due_customer)
                                                {

                                                  $total_due_amount+=$due_customer['due_amount'];
                                                  $sub_total_due_amount +=$due_customer['due_amount'];
                                              ?>
                                                  <tr>
                                                      <td><?=number_format($due_customer['due_amount'],2)?></td>
                                                  </tr>
                                              <?php    
                                                }   
                                              }
                                            ?>
                                        </table>
                                    </td>

                                </tr>

                                <tr>
                                  <td colspan="7" align="right"> 
                                    Sub Total :: 
                                  </td>
                                  <td><?=number_format($sub_total_sell_amount,2)?></td>
                                  <td><?=number_format($sub_total_paid_amount,2)?></td>
                                  <td><?=number_format($sub_total_due_amount,2)?></td>
                              </tr>

                          <?php
                            }
                          ?>

                          <tr>
                              <td colspan="7" align="right"> 
                                Total :: 
                              </td>
                              <td><?=number_format($total_amount,2)?></td>
                              <td><?=number_format($total_paid_amount,2)?></td>
                              <td><?=number_format($total_due_amount,2)?></td>
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

<style type="text/css">
    b{
        font-weight: 700;
    }

    .table tr td{
      height: 60px;
    }
</style>