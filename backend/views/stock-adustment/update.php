<?php
use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ImAdjustHead */

$this->title = 'Update Stock Adjustment: ' . $modelAdjustmentHead->transaction_no;
$this->params['breadcrumbs'][] = ['label' => 'Im Adjust Heads', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $modelAdjustmentHead->id, 'url' => ['view', 'id' => $modelAdjustmentHead->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="page-header">

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=Url::base('')?>">Home</a></li>
        <li class="breadcrumb-item">Inventory</li>
        <li class="breadcrumb-item"><a href="<?= Url::toRoute(['/stock-adjustment']); ?>">Stock Adjustment</a></li>
        <li class="breadcrumb-item active"><?= Html::encode($this->title) ?></li>
      </ol>     
     
      <div class="middle-menu-bar">
        <?= Html::a(Yii::t('app', 'Create Stock Adjustment'), ['create'], ['class' => '']) ?>   
        <?= Html::a(Yii::t('app', 'Manage Stock Adjustment'), ['index'], ['class' => '']) ?>   
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
              <?= Html::encode($this->title) ?>             
          </div>
        </div>


        <div class="panel-body">

        	<?= $this->render('_form', [
		        'modelAdjustmentHead' => $modelAdjustmentHead,
            'modelsAdjustmentDetail' => $modelsAdjustmentDetail
		    ]) ?>

        </div>

    </div>

</div>