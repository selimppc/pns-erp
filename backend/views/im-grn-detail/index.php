<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ImGrnDetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Im Grn Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="im-grn-detail-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Im Grn Detail', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'im_grn_head_id',
            'product_id',
            'batch_number',
            'expire_date',
            // 'receive_quantity',
            // 'cost_price',
            // 'uom',
            // 'quantity',
            // 'row_amount',
            // 'created_by',
            // 'updated_by',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
