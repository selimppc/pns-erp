<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ImGrnHead */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="im-grn-head-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'grn_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pp_purchase_head_id')->textInput() ?>

    <?= $form->field($model, 'am_voucher_head_id')->textInput() ?>

    <?= $form->field($model, 'supplier_id')->textInput() ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'pay_terms')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'branch_id')->textInput() ?>

    <?= $form->field($model, 'tax_rate')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tax_ammount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'discount_rate')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'discount_amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'currency_id')->textInput() ?>

    <?= $form->field($model, 'exchnage_rate')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'prime_amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'net_amount')->textInput(['maxlength' => true]) ?>

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
