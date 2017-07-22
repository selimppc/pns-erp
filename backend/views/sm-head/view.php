<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\SmHead */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sm Heads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sm-head-view">

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
            'sm_number',
            'date',
            'customer_id',
            'doc_type',
            'branch_id',
            'am_coa_id',
            'check_number',
            'currency_id',
            'exchange_rate',
            'note:ntext',
            'tax_rate',
            'tax_amount',
            'discount_rate',
            'discount_amount',
            'prime_amount',
            'net_amount',
            'sign',
            'status',
            'reference_code',
            'gl_voucher_number',
            'created_by',
            'updated_by',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
