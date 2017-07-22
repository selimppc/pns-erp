<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ImGrnHead */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Im Grn Heads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="im-grn-head-view">

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
            'grn_number',
            'pp_purchase_head_id',
            'am_voucher_head_id',
            'supplier_id',
            'date',
            'pay_terms',
            'branch_id',
            'tax_rate',
            'tax_ammount',
            'discount_rate',
            'discount_amount',
            'currency_id',
            'exchnage_rate',
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
