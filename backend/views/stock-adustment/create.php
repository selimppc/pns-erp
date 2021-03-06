<?php
use yii\helpers\Url;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ImAdjustHead */

$this->title = 'Create Stock Adjustment';
$this->params['breadcrumbs'][] = ['label' => 'Im Stock Adjustment', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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
              <?php
                if(isset(\Yii::$app->params['stock_adjustment_create']) && !empty(\Yii::$app->params['stock_adjustment_create'])){
                  echo \Yii::$app->params['stock_adjustment_create'];
                }
              ?>              
          </div>
        </div>

        <div class="panel-body">

        	<?= $this->render('_form', [
            'modelAdjustmentHead' => $modelAdjustmentHead,
		        'modelsAdjustmentDetail' => $modelsAdjustmentDetail,
		    ]) ?>

        </div>

    </div>

</div>