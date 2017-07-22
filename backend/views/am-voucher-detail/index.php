<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AmVoucherDetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Am Voucher Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="am-voucher-detail-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Am Voucher Detail', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'am_voucher_head_id',
            'am_coa_id',
            'am_sub_coa_id',
            'currency_id',
            // 'exchange_rate',
            // 'prime_amount',
            // 'base_amount',
            // 'branch_id',
            // 'note:ntext',
            // 'status',
            // 'created_by',
            // 'updated_by',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
