<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ImTransferHead */

$this->title = 'Create Im Transfer Head';
$this->params['breadcrumbs'][] = ['label' => 'Im Transfer Heads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="im-transfer-head-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
