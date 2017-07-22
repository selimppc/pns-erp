<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ImGrnHead */

$this->title = 'Update Im Grn Head: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Im Grn Heads', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="im-grn-head-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
