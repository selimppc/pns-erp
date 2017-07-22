<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ItImGl */

$this->title = 'Create It Im Gl';
$this->params['breadcrumbs'][] = ['label' => 'It Im Gls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="it-im-gl-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
