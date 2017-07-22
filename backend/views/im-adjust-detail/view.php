<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ImAdjustDetail */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Im Adjust Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="im-adjust-detail-view">

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
            'im_adjust_head_id',
            'product_id',
            'batch_number',
            'expire_date',
            'uom',
            'quantity',
            'stock_rate',
            'created_by',
            'updated_by',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
