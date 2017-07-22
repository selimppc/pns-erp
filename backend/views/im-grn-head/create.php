<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ImGrnHead */

$this->title = 'Create Im Grn Head';
$this->params['breadcrumbs'][] = ['label' => 'Im Grn Heads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="im-grn-head-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
