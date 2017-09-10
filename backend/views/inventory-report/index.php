<?php
	use yii\helpers\Url;
	use yii\helpers\Html;

	$this->title = Yii::t('app', 'Inventory Report');
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
	    		
	    		<a href="<?= Url::toRoute(['/report/item-ledger']); ?>" class="btn btn-block btn-primary waves-effect">Item Ledger</a>
	    		<a href="<?= Url::toRoute(['/report/inventory-movement']); ?>" class="btn btn-block btn-primary waves-effect">Inventory Movement</a>
          <a href="<?= Url::toRoute(['/report/stock-dispatch']); ?>" class="btn btn-block btn-primary waves-effect">Stock Dispatch</a>
          <a href="<?= Url::toRoute(['/report/stock-balance']); ?>" class="btn btn-block btn-primary waves-effect">Stock Balance</a>
          <a href="<?= Url::toRoute(['/report/stock-balance-after-adjustment']); ?>" class="btn btn-block btn-primary waves-effect">Stock Balance after Adjustment</a>
	    		
	    	</div>

	    </div>
	</div>
</div>	    

