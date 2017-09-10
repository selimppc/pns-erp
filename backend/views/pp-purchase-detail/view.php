<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\PpPurchaseDetail */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Purchase Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-header">

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=Url::base('')?>">Home</a></li>
        <li class="breadcrumb-item active"><?= Html::encode($this->title) ?></li>
      </ol>
      
     
      <div class="middle-menu-bar">
        <?= Html::a(Yii::t('app', 'Add New Purchase Details'), ['create'], ['class' => '']) ?>
        <?= Html::a(Yii::t('app', 'Manage Purchase Details'), ['index'], ['class' => '']) ?> 
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'b']) ?> 

         <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => '',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>
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
            <h3 class="panel-title">View :: <?= Html::encode($this->title) ?></h3>
        </header>
         
        <div class="panel-body">

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    [
                        'label'  => 'Purchase Head',
                        'value'  => $model->ppPurchaseHead->po_order_number
                    ],                    
                    [
                        'label'  => 'Product',
                        'value'  => $model->product->title
                    ],
                    'quantity',
                    'grn_quantity',
                    'tax_rate',
                    'tax_amount',
                    [
                        'label'  => 'Uom',
                        'value'  => $model->uomData->title
                    ],
                    'uom_quantity',
                    'unit_quantity',
                    'purchase_rate',
                    'row_amount',
                    'status',
                ],
            ]) ?>

        </div>

    </div>
</div>  