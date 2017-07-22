<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ImAdjustDetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Im Adjust Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="im-adjust-detail-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Im Adjust Detail', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'im_adjust_head_id',
            'product_id',
            'batch_number',
            'expire_date',
            // 'uom',
            // 'quantity',
            // 'stock_rate',
            // 'created_by',
            // 'updated_by',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
