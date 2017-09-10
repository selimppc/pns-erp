<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SmHeadSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sm Heads';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sm-head-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Sm Head', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'sm_number',
            'date',
            'customer_id',
            'doc_type',
            // 'branch_id',
            // 'am_coa_id',
            // 'check_number',
            // 'currency_id',
            // 'exchange_rate',
            // 'note:ntext',
            // 'tax_rate',
            // 'tax_amount',
            // 'discount_rate',
            // 'discount_amount',
            // 'prime_amount',
            // 'net_amount',
            // 'sign',
            // 'status',
            // 'reference_code',
            // 'gl_voucher_number',
            // 'created_by',
            // 'updated_by',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
