<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\PpPurchaseDetail */

$this->title = 'Update Pp Purchase Detail: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pp Purchase Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pp-purchase-detail-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
