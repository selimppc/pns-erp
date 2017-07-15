<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

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
            'currency_id',
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
            'supplier_id',
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
