<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;

use yii\helpers\ArrayHelper;

	$this->title = Yii::t('app', 'Money Recipt List');
	$this->params['breadcrumbs'][] = $this->title;

?>

<div class="page-header">

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=Url::base('')?>">Home</a></li>
        <li class="breadcrumb-item"><?= Html::a(Yii::t('app', 'Manage Money Recipt'), ['index'], ['class' => '']) ?>   </li>
        <li class="breadcrumb-item active"><?=$this->title?></li>
      </ol>
     
      <div class="middle-menu-bar">

        <span style="color: #fff;padding-top: 6px;display: inline-block;padding-left: 10px;">Money receipt list of :: <?=$customer->name?></span>
        
        <?php
          echo \yii\helpers\Html::a( '<i class="icon md-arrow-left" aria-hidden="true"></i> Back', Yii::$app->request->referrer,['class' => 'back']);
        ?>    
      </div>
</div>

<div class="page-content">
    <!-- Panel Basic -->
    <div class="panel">

    	<?php 
            if(Yii::$app->session->hasFlash('success')){
        ?>
            <div class="alert alert-success">
              <?= Yii::$app->session->getFlash('success'); ?>
            </div>
        <?php 
            }
        ?>

        <?php 
            if(Yii::$app->session->hasFlash('error')){
        ?>
            <div class="alert alert-danger">
              <?= Yii::$app->session->getFlash('error'); ?>
            </div>
        <?php 
            }
        ?>

        <div class="panel-body">
        	<div class="row">
	        	<div class="table-responsive">
		        	<table class="table table-striped table-bordered">
		        		<thead>
		        			<tr>
		        				<td>Sales Number</td>
		        				<td>Sales Date</td>
		        				<td>Pay Terms</td>
		        				<td>Total Amount</td>
		        				<td>Total Txt Amt</td>
		        				<td>Discount Amount</td>
		        				<td>Net Amount</td>
		        				<td>Status</td>
		        				<td>Action</td>
		        			</tr>
		        		</thead>
		        		<tbody>
		        			<?php
		        				if(!empty($model))
		        				{
		        					foreach($model as $value)
		        					{
		        			?>
		        						<tr>
		        							<td><?=$value->sm_number?></td>
		        							<td><?=$value->date?></td>
		        							<td><?=$value->pay_terms?></td>
		        							<td><?=$value->prime_amount?></td>
		        							<td><?=$value->tax_amount?></td>
		        							<td><?=$value->discount_amount?></td>
		        							<td><?=$value->net_amount?></td>
		        							<td><?=$value->status?></td>
		        							<td>

		        								<?php
		        									if($value->status == 'open')
		        									{
		        								?>		
			        								<a class="btn btn-xs btn-success waves-effect" href="<?= Url::toRoute(['/money-recipt/approved','id' => $value->id]); ?>" data-pjax="0" onclick="return confirm(&quot;Are you sure you want to approved this money receipt?&quot;) ">Approve</a>

			        								<a class="btn btn-xs btn-danger waves-effect" href="<?= Url::toRoute(['/money-recipt/cancel','id' => $value->id]); ?>" data-pjax="0" onclick="return confirm(&quot;Are you sure you want to cancel this money receipt?&quot;) ">Cancel</a>

			        							<?php
		        									}
		        								?>	
		        							</td>
		        						</tr>

		        			<?php			
		        					}
		        				}
		        			?>
		        		</tbody>
		        	</table>
	        	</div>
        	</div>
        </div>

    </div>
</div>    