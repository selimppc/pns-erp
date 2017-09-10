<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AmCoa */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Am Coa',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Am Coas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="am-coa-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
