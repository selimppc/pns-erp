<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\PpPurchaseHead */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pp Purchase Heads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pp-purchase-head-view">

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
            'po_order_number',
            'date',
            'supplier_id',
            'pay_terms',
            'delivery_date',
            'branch_id',
            'tax_rate',
            'tax_amount',
            'discount_rate',
            'discount_amount',
            'prime_amount',
            'net_amount',
            'status',
            'created_by',
            'updated_by',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
