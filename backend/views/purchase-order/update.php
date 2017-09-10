<?php
use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\PpPurchaseHead */

$this->title = 'Update :: ' . $modelPurchaseHead->po_order_number;
$this->params['breadcrumbs'][] = ['label' => 'Pp Purchase Heads', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $modelPurchaseHead->id, 'url' => ['view', 'id' => $modelPurchaseHead->id]];
$this->params['breadcrumbs'][] = 'Update';
?>


<div class="page-header">

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=Url::base('')?>">Home</a></li>
        <li class="breadcrumb-item">Purchase</li>
        <li class="breadcrumb-item"><a href="<?= Url::toRoute(['/pp-purchase-head']); ?>">Purchase Order</a></li>
        <li class="breadcrumb-item active"><?= Html::encode($this->title) ?></li>
      </ol>
     
      <div class="middle-menu-bar">
        <?= Html::a(Yii::t('app', 'Create Purchase Order'), ['create'], ['class' => '']) ?>   
        <?= Html::a(Yii::t('app', 'Manage '.$this->title), ['index'], ['class' => '']) ?>   
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

	    	<?= $this->render('_form', [
              'modelPurchaseHead' => $modelPurchaseHead,
              'modelsPurchaseDetail' => $modelsPurchaseDetail             
			    ]) ?>

	    </div>

</div>

