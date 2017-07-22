<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ImTransaction */

$this->title = 'Create Im Transaction';
$this->params['breadcrumbs'][] = ['label' => 'Im Transactions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="im-transaction-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
