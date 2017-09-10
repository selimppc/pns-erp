<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;
use backend\models\Branch;
use backend\models\Currency;

/* @var $this yii\web\View */
/* @var $model backend\models\ImTransferHead */
/* @var $form yii\widgets\ActiveForm */
?>



    <?php $form = ActiveForm::begin(); ?>

    <div class="row">

        <div class="col-md-6">

            <?= $form->field($model, 'transfer_number',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'confirm_date',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput() ?>

            <div class="form-group form-material floating" data-plugin="formMaterial">

                <?= $form->field($model, 'from_branch_id')
                            ->dropDownList(
                                ArrayHelper::map(Branch::find()->all(), 'id', 'title'),
                                 ['prompt'=>'-Select-','class'=>'form-control','onchange'=>'function()']
                            ); ?>

            </div>

            <div class="form-group form-material floating" data-plugin="formMaterial">

                <?= $form->field($model, 'from_currency_id')
                            ->dropDownList(
                                ArrayHelper::map(Currency::find()->all(), 'id', 'title'),
                                 ['prompt'=>'-Select-','class'=>'form-control','onchange'=>'function()']
                            ); ?>

            </div>

            <?= $form->field($model, 'from_exchange_rate',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'to_exchange_rate',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

            

        </div>

        <div class="col-md-6">

            <?= $form->field($model, 'date',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput() ?>

            <?= $form->field($model, 'note',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput() ?>

            <div class="form-group form-material floating" data-plugin="formMaterial">

                <?= $form->field($model, 'to_branch_id')
                            ->dropDownList(
                                ArrayHelper::map(Branch::find()->all(), 'id', 'title'),
                                 ['prompt'=>'-Select-','class'=>'form-control','onchange'=>'function()']
                            ); ?>

            </div>

            <div class="form-group form-material floating" data-plugin="formMaterial">

                <?= $form->field($model, 'to_currency_id')
                            ->dropDownList(
                                ArrayHelper::map(Currency::find()->all(), 'id', 'title'),
                                 ['prompt'=>'-Select-','class'=>'form-control','onchange'=>'function()']
                            ); ?>

            </div>  

            <div class="form-group form-material floating" data-plugin="formMaterial">

                <?= $form->field($model, 'status')
                            ->dropDownList(
                                array ('active'=>'Active', 'inactive'=>'Inactive','cancel' => 'Cancel'),
                                array ('class'=>'form-control') 
                            ); ?>

            </div>          

            

        </div>

    </div>    


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Save Changes' : 'Save Changes', ['class' => $model->isNewRecord ? 'btn-primary waves-effect' : 'btn-primary waves-effect']) ?>
    </div>

    <?php ActiveForm::end(); ?>


