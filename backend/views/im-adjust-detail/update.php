<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ImAdjustDetail */

$this->title = 'Update Im Adjust Detail: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Im Adjust Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="im-adjust-detail-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
