<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\SmDetail */

$this->title = 'Create Sm Detail';
$this->params['breadcrumbs'][] = ['label' => 'Sm Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sm-detail-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
