<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ImTransferDetail */

$this->title = 'Update Im Transfer Detail: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Im Transfer Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="im-transfer-detail-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
