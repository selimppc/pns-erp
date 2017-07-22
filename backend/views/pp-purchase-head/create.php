<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\PpPurchaseHead */

$this->title = 'Create Pp Purchase Head';
$this->params['breadcrumbs'][] = ['label' => 'Pp Purchase Heads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pp-purchase-head-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
