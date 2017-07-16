<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\GroupTwo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="group-two-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'group_one_id',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput() ?>

    <?= $form->field($model, 'title',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textarea(['rows' => 6]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-primary waves-effect' : 'btn btn-primary waves-effect']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
