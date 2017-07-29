<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;
use backend\models\Branch;
use backend\models\Currency;

/* @var $this yii\web\View */
/* @var $model backend\models\ImAdjustHead */
/* @var $form yii\widgets\ActiveForm */
?>



    <?php $form = ActiveForm::begin(); ?>

    <div class="row">

        <div class="col-md-6">

            <?= $form->field($model, 'transaction_no',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

            <div class="form-group form-material floating" data-plugin="formMaterial">

                <?= $form->field($model, 'branch_id')
                            ->dropDownList(
                                ArrayHelper::map(Branch::find()->all(), 'id', 'title'),
                                 ['prompt'=>'-Select-','class'=>'form-control']
                            ); ?>

            </div>

            <?= $form->field($model, 'confirm_date',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput() ?>

            <?= $form->field($model, 'exchange_rate',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'voucher_number',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

        </div>

        <div class="col-md-6">

            <?= $form->field($model, 'date',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput() ?>

            <div class="form-group form-material floating" data-plugin="formMaterial">

                <?= $form->field($model, 'type')->dropDownList([ 'positive' => 'Positive', ], ['prompt'=>'-Select-','class'=>'form-control']) ?>

            </div>    

            <div class="form-group form-material floating" data-plugin="formMaterial">

                <?= $form->field($model, 'currency_id')
                            ->dropDownList(
                                ArrayHelper::map(Currency::find()->all(), 'id', 'title'),
                                 ['prompt'=>'-Select-','class'=>'form-control']
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
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary waves-effect' : 'btn btn-primary waves-effect']) ?>
    </div>

    <?php ActiveForm::end(); ?>


