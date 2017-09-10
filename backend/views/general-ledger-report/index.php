<?php
	use yii\helpers\Url;
	use yii\helpers\Html;

	$this->title = Yii::t('app', 'General Ladger Report');
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

      <div id="flag_desc">
          <div id="flag_desc_text">
              <?php
                if(isset(\Yii::$app->params['general_ledger_report']) && !empty(\Yii::$app->params['general_ledger_report'])){
                  echo \Yii::$app->params['general_ledger_report'];
                }
              ?>
          </div>
      </div>
     
	    <div class="panel-body">

	    	<div class="setting-column">
	    		
	    		<a href="<?= Url::toRoute(['/report/consolidated-trial-balance']); ?>" class="btn btn-block btn-primary waves-effect">Consolidated Trial Balance</a>
	    		<a href="<?= Url::toRoute(['/report/trial-balance-all']); ?>" class="btn btn-block btn-primary waves-effect">Trial Balance for ALL</a>
          <a href="<?= Url::toRoute(['/report/chart-of-account-list']); ?>" class="btn btn-block btn-primary waves-effect">Chart of Account List</a>
          <a href="<?= Url::toRoute(['/report/journal-transaction']); ?>" class="btn btn-block btn-primary waves-effect">Journal Transaction</a>
	    		
	    	</div>

        <div class="setting-column">
          
          <a href="<?= Url::toRoute(['/report/balance-sheet']); ?>" class="btn btn-block btn-primary waves-effect">Balance Sheet</a>
          <a href="<?= Url::toRoute(['/report/profit-loss']); ?>" class="btn btn-block btn-primary waves-effect">Profit & Loss</a>
          
        </div>

	    </div>
	</div>
</div>	    

