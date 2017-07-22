<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ItImToAp */

$this->title = 'Update It Im To Ap: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'It Im To Aps', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="it-im-to-ap-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
