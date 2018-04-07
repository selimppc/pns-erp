<?php
	use yii\helpers\Url;
	use yii\helpers\Html;

	$this->title = Yii::t('app', 'Collections Report');
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
	        	Sales collection report of last month of <?=date('Y')?> year
	        </h3>
	     </header>

	     <div class="panel-body">

	     	<?php
	     		
  				for($i=1;$i<=date('n')-1;$i++)
  				{
	     	?>

	     		<div class="setting-column">
	    		
		    		<a href="<?= Url::toRoute(['/report/collection-report', 'first-date' => date('Y-m-d', strtotime("first day of -$i month")),'last-date' => date('Y-m-d', strtotime("last day of -$i month"))]); ?>" class="btn btn-block btn-primary waves-effect">
		    			<?=date('F Y', strtotime("last day of -$i month"));?>
		    		</a>
		    		
		    	</div>

	    	<?php
	    		}
	    	?>

	     </div>

    </div>
</div>    