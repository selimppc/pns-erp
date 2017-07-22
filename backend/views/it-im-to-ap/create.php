<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ItImToAp */

$this->title = 'Create It Im To Ap';
$this->params['breadcrumbs'][] = ['label' => 'It Im To Aps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="it-im-to-ap-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
