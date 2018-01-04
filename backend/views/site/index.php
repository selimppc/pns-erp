<?php
  use yii\helpers\Url;

  $this->title = 'Dashboard';
?>

<div class="page-content container-fluid">
  <div class="row" data-plugin="matchHeight" data-by-row="true">


    <div class="col-xl-4 col-md-4">
          <!-- Widget Linearea One-->
          <div class="card card-shadow" id="widgetLineareaOne">
            <div class="card-block p-20 pt-10" style="background: #20a8d8;">
              <div class="clearfix">
                <div class="white float-left py-10">
                  &#2547;
                  Today's Sales
                </div>
                <span class="float-right white font-size-30"><?=number_format($todays_sale,3)?></span>
              </div>
              <div class="mb-20 white">
                <i class="icon md-long-arrow-up white font-size-16"></i> Today's sales of <?=date('F');?>
              </div>
              
            </div>
          </div>
          <!-- End Widget Linearea One -->
        </div>

        <div class="col-xl-4 col-md-4">
          <!-- Widget Linearea One-->
          <div class="card card-shadow" id="widgetLineareaOne">
            <div class="card-block p-20 pt-10" style="background: #63c2de;">
              <div class="clearfix">
                <div class="white float-left py-10">
                  &#2547; This month sales
                </div>
                <span class="float-right white font-size-30"><?=number_format($this_month_sale,3);?></span>
              </div>
              <div class="mb-20 white">
                <i class="icon md-long-arrow-up white font-size-16"></i>
                Sales of <?=date('F');?>
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
                  &#2547; Total sales
                </div>
                <span class="float-right white font-size-30"><?=number_format($all_sales,3);?></span>
              </div>
              <div class="mb-20 white">
                <i class="icon md-long-arrow-up white font-size-16"></i>
                Total sales of the entire system
              </div>
              
            </div>
          </div>
          <!-- End Widget Linearea One -->
        </div>

        <div class="col-xl-4 col-md-4">
          <!-- Widget Linearea One-->
          <div class="card card-shadow" id="widgetLineareaOne">
            <div class="card-block p-20 pt-10" style="background: #f86c6b;">
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
            <div class="card-block p-20 pt-10" style="background: #3b5998;">
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
            <div class="card-block p-20 pt-10" style="background: #00aced;">
              <div class="clearfix">
                <div class="white float-left py-10">
                  <i class="icon md-chart white font-size-24 vertical-align-bottom mr-5"></i> Upcoming Stock
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

        <div class="col-xl-4 col-md-4">
          <!-- Widget Linearea One-->
          <div class="card card-shadow" id="widgetLineareaOne">
            <div class="card-block p-20 pt-10" style="background: #4875b4;">
              <div class="clearfix">
                <div class="white float-left py-10">
                  <i class="icon md-chart white font-size-24 vertical-align-bottom mr-5"></i>     Today's delivered qty
                </div>
                <span class="float-right white font-size-30"><?=$todays_delivered?></span>
              </div>
              <div class="mb-20 white">
                <i class="icon md-long-arrow-up white font-size-16"></i> Today's delivered of <?=date('F');?>
              </div>
              
            </div>
          </div>
          <!-- End Widget Linearea One -->
        </div>

        <div class="col-xl-4 col-md-4">
          <!-- Widget Linearea One-->
          <div class="card card-shadow" id="widgetLineareaOne">
            <div class="card-block p-20 pt-10" style="background: #d34836;">
              <div class="clearfix">
                <div class="white float-left py-10">
                  <i class="icon md-chart white font-size-24 vertical-align-bottom mr-5"></i> This month delivered qty
                </div>
                <span class="float-right white font-size-30"><?=$this_month_delivered?></span>
              </div>
              <div class="mb-20 white">
                <i class="icon md-long-arrow-up white font-size-16"></i>
                Delivered of <?=date('F');?>
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
                  <i class="icon md-chart white font-size-24 vertical-align-bottom mr-5"></i> Pending delivery
                </div>
                <span class="float-right white font-size-30"><?=$pending_delivered?></span>
              </div>
              <div class="mb-20 white">
                <i class="icon md-long-arrow-up white font-size-16"></i>
                Total pending deliver
              </div>
              
            </div>
          </div>
          <!-- End Widget Linearea One -->
        </div>
    
    
  </div>
</div>