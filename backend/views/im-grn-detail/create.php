<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ImGrnDetail */

$this->title = 'Create Im Grn Detail';
$this->params['breadcrumbs'][] = ['label' => 'Im Grn Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="im-grn-detail-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
