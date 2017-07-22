<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PpPurchaseDetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pp Purchase Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pp-purchase-detail-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Pp Purchase Detail', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'pp_purchase_head_id',
            'product_id',
            'quantity',
            'grn_quantity',
            // 'tax_rate',
            // 'tax_amount',
            // 'uom',
            // 'uom_quantity',
            // 'unit_quantity',
            // 'purchase_rate',
            // 'row_amount',
            // 'status',
            // 'created_by',
            // 'updated_by',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
