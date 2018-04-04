<?php
  use yii\helpers\Url;

  $this->title = 'Dashboard';

?>

<div class="page-content container-fluid">
  <div class="row" data-plugin="matchHeight" data-by-row="true">


    <div class="col-xl-4 col-md-4">
      <!-- Widget Linearea One-->
      <div class="card card-shadow" id="widgetLineareaOne">
        <a href="<?= Url::toRoute(['/report/daily']); ?>" class="card-block p-20 pt-10" style="background: #20a8d8;">
          <div class="clearfix">
            <div class="white float-left py-10">
              &#2547;
              Today's Sales
            </div>
            <span class="float-right white font-size-30"><?=number_format($todays_sale,2)?></span>
          </div>
          <div class="mb-20 white">
            <i class="icon md-long-arrow-up white font-size-16"></i> Today's sales of <?=date('F');?>
          </div>
          <span class="white float-right">Details</span>
        </a>
      </div>
      <!-- End Widget Linearea One -->
    </div>


    <div class="col-xl-4 col-md-4">
      <!-- Widget Linearea One-->
      <div class="card card-shadow" id="widgetLineareaOne">
        <a href="<?= Url::toRoute(['/report/todays-collection']); ?>" class="card-block p-20 pt-10" style="background: #9C27B0;">
          <div class="clearfix">
            <div class="white float-left py-10">
              &#2547;
              Today's Collection
            </div>
            <span class="float-right white font-size-30"><?=number_format($todays_collection,2);?></span>
          </div>
          <div class="mb-20 white">
            <i class="icon md-long-arrow-up white font-size-16"></i> Today's collection of <?=date('F');?>
          </div>
          <span class="white float-right">Details</span>
        </a>
      </div>
      <!-- End Widget Linearea One -->
    </div>

    
    <div class="col-xl-4 col-md-4">
      <!-- Widget Linearea One-->
      <div class="card card-shadow" id="widgetLineareaOne">
        <a href="<?= Url::toRoute(['/report/last-15-days']); ?>" class="card-block p-20 pt-10" style="background: #D81B60;">
          <div class="clearfix">
            <div class="white float-left py-10">
              &#2547;
              Last 15 days sales
            </div>
            <span class="float-right white font-size-30"><?=number_format($last_15_days_sale,2)?></span>
          </div>
          <div class="mb-20 white">
            <!-- <i class="icon md-long-arrow-up white font-size-16"></i> Last 15 days sales -->
          </div>
          <span class="white float-right">Details</span>
        </a>
      </div>
      <!-- End Widget Linearea One -->
    </div>

       


        <div class="col-xl-4 col-md-4">
          <!-- Widget Linearea One-->
          <div class="card card-shadow" id="widgetLineareaOne">
            <a href="<?= Url::toRoute(['/report/last-15-days-collection']); ?>" class="card-block p-20 pt-10" style="background: #673AB7;">
              <div class="clearfix">
                <div class="white float-left py-10">
                  &#2547;
                  Last 15 days collection
                </div>
                <span class="float-right white font-size-30"><?=number_format($last_15_days_collection,2);?></span>
              </div>
              <div class="mb-20 white">
                <!-- <i class="icon md-long-arrow-up white font-size-16"></i> Last 15 days sales -->
              </div>
              <span class="white float-right">Details</span>
            </a>
          </div>
          <!-- End Widget Linearea One -->
        </div>


        <div class="col-xl-4 col-md-4">
          <!-- Widget Linearea One-->
          <div class="card card-shadow" id="widgetLineareaOne">
            <a href="<?= Url::toRoute(['/report/monthly']); ?>" class="card-block p-20 pt-10" style="background: #63c2de;">
              <div class="clearfix">
                <div class="white float-left py-10">
                  &#2547; This month sales
                </div>
                <span class="float-right white font-size-30"><?=number_format($this_month_sale,2);?></span>
              </div>
              <div class="mb-20 white">
                <i class="icon md-long-arrow-up white font-size-16"></i>
                Sales of <?=date('F');?>
              </div>
              <span class="white float-right">Details</span>
            </a>
          </div>
          <!-- End Widget Linearea One -->
        </div>

        <div class="col-xl-4 col-md-4">
          <!-- Widget Linearea One-->
          <div class="card card-shadow" id="widgetLineareaOne">
            <a href="<?= Url::toRoute(['/report/collection-report']); ?>" class="card-block p-20 pt-10" style="background: #3F51B5;">
              <div class="clearfix">
                <div class="white float-left py-10">
                  &#2547; This month collection
                </div>
                <span class="float-right white font-size-30"><?=number_format($this_month_collection,2);?></span>
              </div>
              <div class="mb-20 white">
                <i class="icon md-long-arrow-up white font-size-16"></i>
                Sales of <?=date('F');?>
              </div>
              <span class="white float-right">Details</span>
            </a>
          </div>
          <!-- End Widget Linearea One -->
        </div>
   
        <div class="col-xl-4 col-md-4">
          <!-- Widget Linearea One-->
          <div class="card card-shadow" id="widgetLineareaOne">
            <a href="<?= Url::toRoute(['/report/last-month-of-current-year']); ?>" class="card-block p-20 pt-10" style="background: #43A047;">
              <div class="clearfix">
                <div class="white float-left py-10">
                  &#2547; Total sales of <?=Date('Y')?>
                </div>
                <span class="float-right white font-size-30"><?=number_format($this_year_sale,2);?></span>
              </div>
              <div class="mb-20 white">
                <i class="icon md-long-arrow-up white font-size-16"></i>
                Total sales of current year
              </div>
              
            </a>
          </div>
          <!-- End Widget Linearea One -->
        </div>

        <div class="col-xl-4 col-md-4">
          <!-- Widget Linearea One-->
          <div class="card card-shadow" id="widgetLineareaOne">
            <a href="<?= Url::toRoute(['/report/last-month-of-current-year','type' => 'collection']); ?>" class="card-block p-20 pt-10" style="background: #6D4C41;">
              <div class="clearfix">
                <div class="white float-left py-10">
                  &#2547; Total collections of <?=Date('Y')?>
                </div>
                <span class="float-right white font-size-30"><?=number_format($this_year_collection,2);?></span>
              </div>
              <div class="mb-20 white">
                <i class="icon md-long-arrow-up white font-size-16"></i>
                Total collections of current year
              </div>
              
            </a>
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
                <span class="float-right white font-size-30"><?=number_format($all_sales,2);?></span>
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
            <div class="card-block p-20 pt-10" style="background: #2196F3;">
              <div class="clearfix">
                <div class="white float-left py-10">
                  &#2547; Total collection
                </div>
                <span class="float-right white font-size-30"><?=number_format($all_collection,2);?></span>
              </div>
              <div class="mb-20 white">
                <i class="icon md-long-arrow-up white font-size-16"></i>
                Total collection of the entire system
              </div>
              
            </div>
          </div>
          <!-- End Widget Linearea One -->
        </div>

         <div class="col-xl-4 col-md-4">
          <!-- Widget Linearea One-->
          <div class="card card-shadow" id="widgetLineareaOne">
            <a href="<?= Url::toRoute(['/report/total-due']); ?>" class="card-block p-20 pt-10" style="background: #00BCD4;">
            
              <div class="clearfix">
                <div class="white float-left py-10">
                  &#2547; Total Due
                </div>
                <span class="float-right white font-size-30"><?=number_format($total_due,2)?></span>
              </div>
              <div class="mb-20 white">
                <i class="icon md-long-arrow-up white font-size-16"></i>
                Total due of the entire system
              </div>
              
            </a>
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

        <!-- <div class="col-xl-4 col-md-4">
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
        </div> -->

        <!-- <div class="col-xl-4 col-md-4">
          
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
         
        </div> -->

        <!-- <div class="col-xl-4 col-md-4">
          
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
          
        </div> -->
    
    
  </div>
</div>