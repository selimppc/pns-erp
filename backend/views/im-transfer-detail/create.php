<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ImTransferDetail */

$this->title = 'Create Im Transfer Detail';
$this->params['breadcrumbs'][] = ['label' => 'Im Transfer Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="im-transfer-detail-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
