<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\GroupOne */

$this->title = Yii::t('app', 'Create Group One');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Group Ones'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="group-one-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
