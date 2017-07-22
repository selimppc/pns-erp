<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\SmDetail */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sm Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sm-detail-view">

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
            'sm_head_id',
            'product_id',
            'uom',
            'uom_quantity',
            'rate',
            'bonus_quantity',
            'quantity',
            'row_amount',
            'created_by',
            'updated_by',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
