<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\AmVoucherDetail */

$this->title = 'Create Am Voucher Detail';
$this->params['breadcrumbs'][] = ['label' => 'Am Voucher Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="am-voucher-detail-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
