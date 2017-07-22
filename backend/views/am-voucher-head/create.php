<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\AmVoucherHead */

$this->title = 'Create Am Voucher Head';
$this->params['breadcrumbs'][] = ['label' => 'Am Voucher Heads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="am-voucher-head-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
