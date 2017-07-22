<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\PpPurchaseDetail */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pp Purchase Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pp-purchase-detail-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'pp_purchase_head_id',
            'product_id',
            'quantity',
            'grn_quantity',
            'tax_rate',
            'tax_amount',
            'uom',
            'uom_quantity',
            'unit_quantity',
            'purchase_rate',
            'row_amount',
            'status',
            'created_by',
            'updated_by',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
