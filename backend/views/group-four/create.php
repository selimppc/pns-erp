<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\GroupFour */

$this->title = Yii::t('app', 'Create Group Four');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Group Fours'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="group-four-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
