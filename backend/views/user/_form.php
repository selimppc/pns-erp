<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>



<?php $form = ActiveForm::begin(); ?>

	<div class="row">

        <div class="col-md-6">

        	<?= $form->field($model, 'first_name',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

        	<?= $form->field($model, 'username',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

        	<?= $form->field($model, 'password',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->passwordInput(['maxlength' => true]) ?>

        </div>

        <div class="col-md-6">

        	<?= $form->field($model, 'last_name',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

        	 <?= $form->field($model, 'email',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

        </div>

    </div>

    

    <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Save Changes') : Yii::t('app', 'Save Changes'), ['class' => $model->isNewRecord ? 'btn btn-primary waves-effect' : 'btn btn-primary waves-effect']) ?>
   

<?php ActiveForm::end(); ?>


