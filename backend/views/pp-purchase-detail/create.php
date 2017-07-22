<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\PpPurchaseDetail */

$this->title = 'Create Pp Purchase Detail';
$this->params['breadcrumbs'][] = ['label' => 'Pp Purchase Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pp-purchase-detail-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
