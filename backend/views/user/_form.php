<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>



<?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'first_name',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>


    <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-primary waves-effect' : 'btn btn-primary waves-effect']) ?>
   

<?php ActiveForm::end(); ?>


