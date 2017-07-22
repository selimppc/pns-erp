<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\AmVoucherHead */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Am Voucher Heads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="am-voucher-head-view">

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
            'voucher_number',
            'date',
            'reference',
            'year',
            'period',
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
