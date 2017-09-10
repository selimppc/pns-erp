<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SmDetail */

$this->title = 'Update Sm Detail: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sm Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sm-detail-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
