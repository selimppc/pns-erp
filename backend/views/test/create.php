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


<div class="page-content">
    <!-- Panel Basic -->
    <div class="panel">

     
     
	    <div class="panel-body">

	    	<?= $this->render('_form', [
			        'modelPurchaseHead' => $modelPurchaseHead ,
              'modelsPurchaseDetail' => $modelsPurchaseDetail            
			    ]) ?>

	    </div>

</div>

<?php Pjax::end(); ?>