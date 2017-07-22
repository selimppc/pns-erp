<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AmVoucherDetail */

$this->title = 'Update Am Voucher Detail: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Am Voucher Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="am-voucher-detail-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
