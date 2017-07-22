<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ImAdjustHead */

$this->title = 'Update Im Adjust Head: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Im Adjust Heads', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="im-adjust-head-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
