<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;
use backend\models\AmVoucherHead;
use backend\models\AmCoa;
use backend\models\Currency;
use backend\models\Branch;

/* @var $this yii\web\View */
/* @var $model backend\models\AmVoucherDetail */
/* @var $form yii\widgets\ActiveForm */
?>

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">

        <div class="col-md-6">

            <div class="form-group form-material floating" data-plugin="formMaterial">

                <?= $form->field($model, 'am_voucher_head_id')
                            ->dropDownList(
                                ArrayHelper::map(AmVoucherHead::find()->all(), 'id', 'voucher_number'),
                                 ['prompt'=>'-Select-','class'=>'form-control']
                            ); ?>

            </div> 

            <div class="form-group form-material floating" data-plugin="formMaterial">

                <?= $form->field($model, 'am_sub_coa_id')
                            ->dropDownList(
                                ArrayHelper::map(AmCoa::find()->all(), 'id', 'title'),
                                 ['prompt'=>'-Select-','class'=>'form-control']
                            ); ?>

            </div>

            <?= $form->field($model, 'exchange_rate',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'base_amount',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'note',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput() ?>

        </div>

        <div class="col-md-6">

            <div class="form-group form-material floating" data-plugin="formMaterial">

                <?= $form->field($model, 'am_coa_id')
                            ->dropDownList(
                                ArrayHelper::map(AmCoa::find()->all(), 'id', 'title'),
                                 ['prompt'=>'-Select-','class'=>'form-control']
                            ); ?>

            </div>

            <div class="form-group form-material floating" data-plugin="formMaterial">

                <?= $form->field($model, 'currency_id')
                            ->dropDownList(
                                ArrayHelper::map(Currency::find()->all(), 'id', 'title'),
                                 ['prompt'=>'-Select-','class'=>'form-control']
                            ); ?>

            </div>

            <?= $form->field($model, 'prime_amount',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

            <div class="form-group form-material floating" data-plugin="formMaterial">

                <?= $form->field($model, 'branch_id')
                            ->dropDownList(
                                ArrayHelper::map(Branch::find()->all(), 'id', 'title'),
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
        <?= Html::submitButton($model->isNewRecord ? 'Save Changes' : 'Save Changes', ['class' => $model->isNewRecord ? 'btn btn-primary waves-effect' : 'btn btn-primary waves-effect']) ?>
    </div>

    <?php ActiveForm::end(); ?>

