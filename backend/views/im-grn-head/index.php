<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ImGrnHeadSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Im Grn Heads';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="im-grn-head-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Im Grn Head', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'grn_number',
            'pp_purchase_head_id',
            'am_voucher_head_id',
            'supplier_id',
            // 'date',
            // 'pay_terms',
            // 'branch_id',
            // 'tax_rate',
            // 'tax_ammount',
            // 'discount_rate',
            // 'discount_amount',
            // 'currency_id',
            // 'exchnage_rate',
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
