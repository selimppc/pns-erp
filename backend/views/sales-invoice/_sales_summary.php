<?php
  use yii\helpers\Url;
?>



        <?php
          if(isset($last_15_days_sale))
          {
        ?>
            <div class="col-xl-4 col-md-4">
              <!-- Widget Linearea One-->
              <div class="card card-shadow" id="widgetLineareaOne">
                <a href="<?= Url::toRoute(['/report/last-15-days']); ?>" class="card-block p-20 pt-10" style="background: #D81B60;">
                  <div class="clearfix">
                    <div class="white float-left py-10">
                      &#2547;
                      Last 15 days
                    </div>
                    <span class="float-right white font-size-30"><?=number_format($last_15_days_sale,2)?></span>
                  </div>
                  <div class="mb-20 white">
                    <i class="icon md-long-arrow-up white font-size-16"></i> Last 15 days sales
                  </div>
                  <span class="white float-right">Details</span>
                </a>
              </div>
              <!-- End Widget Linearea One -->
            </div>

        <?php
          }
        ?>

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