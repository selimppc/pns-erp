<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\GroupThree */

$this->title = Yii::t('app', 'Create Group Three');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Group Threes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="group-three-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
