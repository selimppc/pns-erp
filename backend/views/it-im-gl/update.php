<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ItImGl */

$this->title = 'Update It Im Gl: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'It Im Gls', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="it-im-gl-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
