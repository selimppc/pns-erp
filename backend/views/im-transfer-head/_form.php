<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ImTransferHead */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="im-transfer-head-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'transfer_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'confirm_date')->textInput() ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'from_branch_id')->textInput() ?>

    <?= $form->field($model, 'from_currency_id')->textInput() ?>

    <?= $form->field($model, 'from_exchange_rate')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'to_branch_id')->textInput() ?>

    <?= $form->field($model, 'to_currency_id')->textInput() ?>

    <?= $form->field($model, 'to_exchange_rate')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
