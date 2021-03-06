<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;


/* @var $this yii\web\View */
/* @var $model backend\models\PpPurchaseHead */

$this->title = 'Create Purchase Order';
$this->params['breadcrumbs'][] = ['label' => 'Pp Purchase Heads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php Pjax::begin(); ?> 
<div class="page-header">

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=Url::base('')?>">Home</a></li>
        <li class="breadcrumb-item">Purchase</li>
        <li class="breadcrumb-item"><a href="<?= Url::toRoute(['/purchase-order']); ?>">Purchase Order</a></li>
        <li class="breadcrumb-item active"><?= Html::encode($this->title) ?></li>
      </ol>
     
      <div class="middle-menu-bar">
        <?= Html::a(Yii::t('app', 'Create '.$this->title), ['create'], ['class' => '']) ?>   
        <?= Html::a(Yii::t('app', 'Manage Purchase Order'), ['index'], ['class' => '']) ?>   
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
                if(isset(\Yii::$app->params['purchase_order_create']) && !empty(\Yii::$app->params['purchase_order_create'])){
                  echo \Yii::$app->params['purchase_order_create'];
                }
              ?>              
          </div>
      </div>
     
	    <div class="panel-body">

	    	<?= $this->render('_form', [
			        'modelPurchaseHead' => $modelPurchaseHead ,
              'modelsPurchaseDetail' => $modelsPurchaseDetail            
			    ]) ?>

	    </div>

</div>

<?php Pjax::end(); ?>