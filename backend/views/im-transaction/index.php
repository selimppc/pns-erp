<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ImTransactionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Im Transactions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="im-transaction-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Im Transaction', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'transaction_number',
            'product_id',
            'branch_id',
            'batch_number',
            // 'date',
            // 'expire_date',
            // 'uom',
            // 'quantity',
            // 'sign',
            // 'foreign_rate',
            // 'rate',
            // 'total_price',
            // 'base_value',
            // 'reference_number',
            // 'reference_row',
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
