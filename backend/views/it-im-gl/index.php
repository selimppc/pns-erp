<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ItImGlSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'It Im Gls';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="it-im-gl-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create It Im Gl', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'branch_id',
            'transaction_code',
            'group',
            'dr_coa_id',
            // 'cr_coa_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
