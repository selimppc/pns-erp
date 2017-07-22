<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ImTransferHeadSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Im Transfer Heads';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="im-transfer-head-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Im Transfer Head', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'transfer_number',
            'date',
            'confirm_date',
            'note:ntext',
            // 'from_branch_id',
            // 'from_currency_id',
            // 'from_exchange_rate',
            // 'to_branch_id',
            // 'to_currency_id',
            // 'to_exchange_rate',
            // 'status',
            // 'created_by',
            // 'updated_by',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
