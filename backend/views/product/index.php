<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Products');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Product'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'product_code',
            'title',
            'description:ntext',
            'image',
            // 'thumb_image',
            // 'class',
            // 'group',
            // 'category',
            // 'currency_id',
            // 'model',
            // 'size',
            // 'origin',
            // 'exchange_rate',
            // 'sell_rate',
            // 'cost_price',
            // 'sell_uom',
            // 'sell_uom_qty',
            // 'purchase_uom',
            // 'purchase_uom_qty',
            // 'sell_tax',
            // 'stock_uom',
            // 'stock_uom_qty',
            // 'pack_size',
            // 'stock_type',
            // 'generic',
            // 'supplier_id',
            // 'manufacture_code',
            // 'max_level',
            // 'min_level',
            // 're_order',
            // 'created_by',
            // 'updated_by',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
