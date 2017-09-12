<?php
use yii\helpers\Url;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ImTransferHead */

$this->title = 'Create Stock Transfer';
$this->params['breadcrumbs'][] = ['label' => 'Stock Transfer', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-header">

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=Url::base('')?>">Home</a></li>
        <li class="breadcrumb-item">Inventory</li>
        <li class="breadcrumb-item active"><?= Html::encode($this->title) ?></li>
      </ol>     
     
      <div class="middle-menu-bar">
        <?= Html::a(Yii::t('app', 'Add New Stock Transfer'), ['create'], ['class' => '']) ?>
        <?= Html::a(Yii::t('app', 'Manage Stock Transfer'), ['index'], ['class' => '']) ?>   
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
                if(isset(\Yii::$app->params['stock_transfer_create']) && !empty(\Yii::$app->params['stock_transfer_create'])){
                  echo \Yii::$app->params['stock_transfer_create'];
                }
              ?>              
          </div>
      </div>,
     
	    <div class="panel-body">

	    	<?= $this->render('_form', [
			        'modelTransferHead' => $modelTransferHead,
              'modelsTransferDetail' => $modelsTransferDetail             
			    ]) ?>

	    </div>

</div>
