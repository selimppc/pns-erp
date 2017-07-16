<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-header">

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=Url::base('')?>">Home</a></li>
        <li class="breadcrumb-item active"><?= Html::encode($this->title) ?></li>
      </ol>
      
     
      <div class="middle-menu-bar">
        <?= Html::a(Yii::t('app', 'Create Product'), ['create'], ['class' => '']) ?>   
        <?= Html::a(Yii::t('app', 'Manage Products'), ['index'], ['class' => '']) ?> 
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'b']) ?> 

         <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => '',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>
        <?php
          echo \yii\helpers\Html::a( 'Back', Yii::$app->request->referrer,['class' => 'back']);
        ?>    
      </div>
</div>

<div class="page-content">
    <!-- Panel Basic -->
    <div class="panel">

    <header class="panel-heading">
        <div class="panel-actions"></div>
        <h3 class="panel-title">Update :: <?= Html::encode($this->title) ?></h3>
    </header>
     
    <div class="panel-body">

        <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'product_code',
            'title',
            'description:ntext',
            'image',
            'thumb_image',
            'class',
            'group',
            'category',
            [
                'label'  => 'Currency',
                'value'  => $model->currency->title
            ],
            'model',
            'size',
            'origin',
            'exchange_rate',
            'sell_rate',
            'cost_price',
            'sell_uom',
            'sell_uom_qty',
            'purchase_uom',
            'purchase_uom_qty',
            'sell_tax',
            'stock_uom',
            'stock_uom_qty',
            'pack_size',
            'stock_type',
            'generic',
            [
                'label'  => 'Supplier',
                'value'  => $model->supplier->supplier_code
            ],
            'manufacture_code',
            'max_level',
            'min_level',
            're_order',
            'created_by',
            'updated_by',
            'created_at',
            'updated_at',
        ],
    ]) ?>

    </div>

</div>

