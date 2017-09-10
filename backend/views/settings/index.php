<?php
	use yii\helpers\Url;
	use yii\helpers\Html;
	use yii\widgets\Pjax;

	$this->title = Yii::t('app', 'Settings');
	$this->params['breadcrumbs'][] = $this->title;
?>

<?php Pjax::begin(); ?> 

<div class="page-header">

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=Url::base('')?>">Home</a></li>
        <li class="breadcrumb-item active">Settings</li>
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

    	<div id="flag_desc">
          <div id="flag_desc_text">
              <?php

              	if(isset(\Yii::$app->params['settings']) && !empty(\Yii::$app->params['settings'])){
              		echo \Yii::$app->params['settings'];
              	}
              	
              ?>
          </div>
      	</div>
      
	    <div class="panel-body">

	    	<div class="setting-column">
	    		<h2>Product Master</h2>
	    		<a href="<?= Url::toRoute(['/codes-param/codes-params-option','type' => 'Product Class']); ?>" class="btn btn-block btn-primary waves-effect">Product Class Setup</a>
	    		<a href="<?= Url::toRoute(['/codes-param/codes-params-option','type' => 'Product Group']); ?>" class="btn btn-block btn-primary waves-effect">Product Group Setup</a>
	    		<a href="<?= Url::toRoute(['/codes-param/codes-params-option','type' => 'Product Category']); ?>" class="btn btn-block btn-primary waves-effect">Product Category Setup</a>
	    		<a href="<?= Url::toRoute(['/codes-param/codes-params-option','type' => 'Unit Of Measurement']); ?>" class="btn btn-block btn-primary waves-effect">Unit of Measurement Setup</a>
	    	</div>

	    	<div class="setting-column">
	    		<h2>Supplier Master</h2>
	    		<a href="<?= Url::toRoute(['/codes-param/codes-params-option','type' => 'Supplier Group']); ?>" class="btn btn-block btn-primary waves-effect">Supplier Group Setup</a>
	    	</div>

	    	<div class="setting-column">
	    		<h2>Customer Master</h2>
	    		<a href="<?= Url::toRoute(['/codes-param/codes-params-option','type' => 'Customer Group']); ?>" class="btn btn-block btn-primary waves-effect">Customer Group Setup</a>
	    		<a href="<?= Url::toRoute(['/transaction-code','type' => 'CUSTOMER TRN NUMBER']); ?>" class="btn btn-block btn-primary waves-effect">Customer Transaction No Setup</a>
	    	</div>

	    	<div class="setting-column">
	    		<h2>Group Master</h2>
	    		<a href="<?= Url::toRoute(['/group-one']); ?>" class="btn btn-block btn-primary waves-effect">Group One</a>
	    		<a href="<?= Url::toRoute(['/group-two']); ?>" class="btn btn-block btn-primary waves-effect">Group Two</a>
	    		<a href="<?= Url::toRoute(['/group-three']); ?>" class="btn btn-block btn-primary waves-effect">Group Three</a>
	    		<a href="<?= Url::toRoute(['/group-four']); ?>" class="btn btn-block btn-primary waves-effect">Group Four</a>
	    	</div>


	    </div>

    </div>
</div>
<?php Pjax::end(); ?>