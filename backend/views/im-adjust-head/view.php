<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ImAdjustHead */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Im Adjust Heads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="im-adjust-head-view">

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
            'transaction_no',
            'date',
            'branch_id',
            'type',
            'confirm_date',
            'currency_id',
            'exchange_rate',
            'voucher_number',
            'status',
            'created_by',
            'updated_by',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
