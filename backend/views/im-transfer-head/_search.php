<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ImTransferHeadSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="im-transfer-head-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'transfer_number') ?>

    <?= $form->field($model, 'date') ?>

    <?= $form->field($model, 'confirm_date') ?>

    <?= $form->field($model, 'note') ?>

    <?php // echo $form->field($model, 'from_branch_id') ?>

    <?php // echo $form->field($model, 'from_currency_id') ?>

    <?php // echo $form->field($model, 'from_exchange_rate') ?>

    <?php // echo $form->field($model, 'to_branch_id') ?>

    <?php // echo $form->field($model, 'to_currency_id') ?>

    <?php // echo $form->field($model, 'to_exchange_rate') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
