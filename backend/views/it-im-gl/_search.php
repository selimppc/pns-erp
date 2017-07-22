<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ItImGlSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="it-im-gl-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'branch_id') ?>

    <?= $form->field($model, 'transaction_code') ?>

    <?= $form->field($model, 'group') ?>

    <?= $form->field($model, 'dr_coa_id') ?>

    <?php // echo $form->field($model, 'cr_coa_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
