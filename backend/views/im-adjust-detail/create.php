<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ImAdjustDetail */

$this->title = 'Create Im Adjust Detail';
$this->params['breadcrumbs'][] = ['label' => 'Im Adjust Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="im-adjust-detail-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
