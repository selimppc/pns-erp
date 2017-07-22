<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ItImToAp */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="it-im-to-ap-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'item_group')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sub_group')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dr_coa_id')->textInput() ?>

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
