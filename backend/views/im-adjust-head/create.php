<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ImAdjustHead */

$this->title = 'Create Im Adjust Head';
$this->params['breadcrumbs'][] = ['label' => 'Im Adjust Heads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="im-adjust-head-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
