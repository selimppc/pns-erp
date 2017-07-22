<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\SmHead */

$this->title = 'Create Sm Head';
$this->params['breadcrumbs'][] = ['label' => 'Sm Heads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sm-head-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
