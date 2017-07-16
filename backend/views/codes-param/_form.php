<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;
use backend\models\AmCoa;

/* @var $this yii\web\View */
/* @var $model backend\models\CodesParam */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="codes-param-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'type',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'code',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

    <div class="form-group form-material" data-plugin="formMaterial">

        <?= $form->field($model, 'am_coa_id')
                    ->dropDownList(
                        ArrayHelper::map(AmCoa::find()->all(), 'id', 'title'),
                         ['prompt'=>'-Select-','class'=>'form-control']
                    ); ?>

    </div>

    <div class="form-group form-material" data-plugin="formMaterial">

        <?= $form->field($model, 'am_coa_cr_id')
                    ->dropDownList(
                        ArrayHelper::map(AmCoa::find()->all(), 'id', 'title'),
                         ['prompt'=>'-Select-','class'=>'form-control']
                    ); ?>

    </div>

    <div class="form-group form-material" data-plugin="formMaterial">

        <?= $form->field($model, 'am_coa_dr_id')
                    ->dropDownList(
                        ArrayHelper::map(AmCoa::find()->all(), 'id', 'title'),
                         ['prompt'=>'-Select-','class'=>'form-control']
                    ); ?>

    </div>

    <?= $form->field($model, 'long',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'percentage',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'am_coa_tax_id',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput() ?>

    <div class="form-group form-material" data-plugin="formMaterial">

        <?= $form->field($model, 'status')
                    ->dropDownList(
                        array ('active'=>'Active', 'inactive'=>'Inactive','cancel' => 'Cancel'),
                        array ('class'=>'form-control') 
                    ); ?>

    </div>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-primary waves-effect' : 'btn btn-primary waves-effect']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
