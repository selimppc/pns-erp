<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ImTransferHead */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Im Transfer Heads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="im-transfer-head-view">

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
            'transfer_number',
            'date',
            'confirm_date',
            'note:ntext',
            'from_branch_id',
            'from_currency_id',
            'from_exchange_rate',
            'to_branch_id',
            'to_currency_id',
            'to_exchange_rate',
            'status',
            'created_by',
            'updated_by',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
