<?php
	use yii\helpers\Url;
	use yii\helpers\Html;

	$this->title = Yii::t('app', 'Settings');
	$this->params['breadcrumbs'][] = $this->title;
?>

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

      <header class="panel-heading">
        <div class="panel-actions"></div>
        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
      </header>
     
	    <div class="panel-body">

	    	<div class="setting-column">
	    		<a href="<?= Url::toRoute(['/group-one']); ?>" class="btn btn-block btn-primary waves-effect">Group One</a>
	    		<a href="<?= Url::toRoute(['/group-two']); ?>" class="btn btn-block btn-primary waves-effect">Group Two</a>
	    		<a href="<?= Url::toRoute(['/group-three']); ?>" class="btn btn-block btn-primary waves-effect">Group Three</a>
	    		<a href="<?= Url::toRoute(['/group-four']); ?>" class="btn btn-block btn-primary waves-effect">Group Four</a>
	    	</div>

	    	<div class="setting-column">
	    		<a href="<?= Url::toRoute(['/codes-param']); ?>" class="btn btn-block btn-primary waves-effect">Codes Param</a>
	    		<a href="<?= Url::toRoute(['/branch']); ?>" class="btn btn-block btn-primary waves-effect">Branch</a>
	    		<a href="<?= Url::toRoute(['/company']); ?>" class="btn btn-block btn-primary waves-effect">Company</a>
	    	</div>

	    	<div class="setting-column">
	    		<a href="<?= Url::toRoute(['/currency']); ?>" class="btn btn-block btn-primary waves-effect">Currency</a>
	    	</div>

	    </div>

    </div>
</div>