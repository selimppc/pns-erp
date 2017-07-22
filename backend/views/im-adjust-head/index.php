<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ImAdjustHeadSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Im Adjust Heads';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="im-adjust-head-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Im Adjust Head', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'transaction_no',
            'date',
            'branch_id',
            'type',
            // 'confirm_date',
            // 'currency_id',
            // 'exchange_rate',
            // 'voucher_number',
            // 'status',
            // 'created_by',
            // 'updated_by',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
