<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ImTransferHead */

$this->title = 'Update Im Transfer Head: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Im Transfer Heads', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="im-transfer-head-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
