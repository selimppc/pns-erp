<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\AmVoucherDetail */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Am Voucher Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="am-voucher-detail-view">

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
            'am_voucher_head_id',
            'am_coa_id',
            'am_sub_coa_id',
            'currency_id',
            'exchange_rate',
            'prime_amount',
            'base_amount',
            'branch_id',
            'note:ntext',
            'status',
            'created_by',
            'updated_by',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
