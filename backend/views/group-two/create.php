<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\GroupTwo */

$this->title = Yii::t('app', 'Create Group Two');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Group Twos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="group-two-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
