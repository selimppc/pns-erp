<?php
	use yii\helpers\Url;
	use yii\helpers\Html;
  use yii\widgets\Pjax;

	$this->title = Yii::t('app', 'Purchase Settings');
	$this->params['breadcrumbs'][] = $this->title;
?>
<?php Pjax::begin(); ?> 
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
                if(isset(\Yii::$app->params['purchase_settings']) && !empty(\Yii::$app->params['purchase_settings'])){
                  echo \Yii::$app->params['purchase_settings'];
                }
              ?>              
          </div>
      </div>
     
	    <div class="panel-body">

	    	<div class="setting-column">
	    		
	    		<a href="<?= Url::toRoute(['/transaction-code','type' => 'REQUISITION NUMBER']); ?>" class="btn btn-block btn-primary waves-effect">Requisition Number</a>
	    		<a href="<?= Url::toRoute(['/transaction-code','type' => 'PURCHASE ORDER NUMBER']); ?>" class="btn btn-block btn-primary waves-effect">Purchase Order Number</a>
	    		
	    	</div>

	    </div>
	</div>
</div>	    
<?php Pjax::end(); ?>