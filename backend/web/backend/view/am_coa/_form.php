<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AmCoa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="am-coa-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'account_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'account_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'account_usage')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'group_one_id')->textInput() ?>

    <?= $form->field($model, 'group_two_id')->textInput() ?>

    <?= $form->field($model, 'group_three_id')->textInput() ?>

    <?= $form->field($model, 'group_four_id')->textInput() ?>

    <?= $form->field($model, 'analyical_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'branch_id')->textInput() ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
