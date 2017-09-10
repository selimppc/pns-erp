<?php
	use yii\helpers\Url;
	use yii\helpers\Html;

	$this->title = Yii::t('app', 'Master Report');
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
                  if(isset(\Yii::$app->params['master_report']) && !empty(\Yii::$app->params['master_report'])){
                    echo \Yii::$app->params['master_report'];
                  }
              ?>
          </div>
      </div>

      <div class="panel-body">

      	<div class="setting-column">

      		<a href="<?= Url::toRoute(['/report/product-list']); ?>" class="btn btn-block btn-primary waves-effect">Product List Report</a>

      		<a href="<?= Url::toRoute(['/report/customer-ledger-report']); ?>" class="btn btn-block btn-primary waves-effect">Customer Ledger Report</a>

      	</div>

      </div>

    </div>
</div>
