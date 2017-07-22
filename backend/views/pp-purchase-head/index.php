<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PpPurchaseHeadSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pp Purchase Heads';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pp-purchase-head-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Pp Purchase Head', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'po_order_number',
            'date',
            'supplier_id',
            'pay_terms',
            // 'delivery_date',
            // 'branch_id',
            // 'tax_rate',
            // 'tax_amount',
            // 'discount_rate',
            // 'discount_amount',
            // 'prime_amount',
            // 'net_amount',
            // 'status',
            // 'created_by',
            // 'updated_by',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
