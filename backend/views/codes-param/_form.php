<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CodesParam */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="codes-param-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'type',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'code',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'am_coa_id',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput() ?>

    <?= $form->field($model, 'am_coa_cr_id',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput() ?>

    <?= $form->field($model, 'am_coa_dr_id',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput() ?>

    <?= $form->field($model, 'long',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'percentage',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'am_coa_tax_id',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput() ?>

    <?= $form->field($model, 'status',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-primary waves-effect' : 'btn btn-primary waves-effect']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
