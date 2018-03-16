<?php
	use yii\helpers\Url;
	use yii\helpers\Html;

	$this->title = Yii::t('app', 'Sales Collection Report');
	$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-header">

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=Url::base('')?>">Home</a></li>
        <li class="breadcrumb-item active"><?=$this->title?></li>
      </ol>
     
      <div class="middle-menu-bar">
        
        <?php
          echo \yii\helpers\Html::a( '<i class="icon md-arrow-left" aria-hidden="true"></i> Back', Yii::$app->request->referrer,['class' => 'back']);
        ?>    
      </div>
</div>

<div class="page-content">
    <!-- Panel Basic -->
    <div class="panel">

    	<header class="panel-heading">
	        <div class="panel-actions"></div>
	        <h3 class="panel-title">
	        	Sales collection report of last 15 days
	        </h3>
	     </header>

	     <div class="panel-body">

	     	<?php
	     		$i=15;
  				//echo date('Y-m-d', strtotime("-$i days"));
  				for($date=1;$date<=$i;$date++)
  				{
	     	?>

	     		<div class="setting-column">
	    		
		    		<a href="<?= Url::toRoute(['/report/todays-collection', 'date' => date('Y-m-d', strtotime("-$date days"))]); ?>" class="btn btn-block btn-primary waves-effect">
		    			<?=date('jS F Y', strtotime("-$date days"));?>
		    		</a>
		    		
		    	</div>

	    	<?php
	    		}
	    	?>

	     </div>

    </div>
</div>    