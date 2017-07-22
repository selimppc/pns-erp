<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SmDetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sm Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sm-detail-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Sm Detail', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'sm_head_id',
            'product_id',
            'uom',
            'uom_quantity',
            // 'rate',
            // 'bonus_quantity',
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
