<?php
	use yii\helpers\Url;
	use yii\helpers\Html;

	$this->title = Yii::t('app', 'Sales Settings');
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
	        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
	    </header>

	    <div class="panel-body">

	    	<div class="setting-column">

	    		<a href="<?= Url::toRoute(['/transaction-code','type' => 'INVOICE NUMBER']); ?>" class="btn btn-block btn-primary waves-effect">Invoice Number</a>

	    		<a href="<?= Url::toRoute(['/transaction-code','type' => 'IM TRANSACTION']); ?>" class="btn btn-block btn-primary waves-effect">Sales Return Number</a>

	    		<a href="<?= Url::toRoute(['/transaction-code','type' => 'MONEY RECEIPT']); ?>" class="btn btn-block btn-primary waves-effect">Money Receipt Number</a>

	    	</div>

	    </div>

    </div>
</div>    