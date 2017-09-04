<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;
use backend\models\PpPurchaseHead;
use backend\models\AmVoucherHead;
use backend\models\Supplier;
use backend\models\Branch;
use backend\models\Currency;

/* @var $this yii\web\View */
/* @var $model backend\models\ImGrnHead */
/* @var $form yii\widgets\ActiveForm */
?>

    <?php $form = ActiveForm::begin(); ?>

        <div class="row">

            <div class="col-md-12">

                <?= $form->field($model, 'grn_number',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'tax_ammount',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'tax_rate',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'discount_rate',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'discount_amount',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'exchnage_rate',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'net_amount',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'prime_amount',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'pay_terms',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

            </div>

            <div class="col-md-12">

                <?= $form->field($model, 'date',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput() ?>

                <div class="form-group form-material floating" data-plugin="formMaterial">

                <?= $form->field($model, 'am_voucher_head_id')
                            ->dropDownList(
                                ArrayHelper::map(AmVoucherHead::find()->all(), 'id', 'voucher_number'),
                                 ['prompt'=>'-Select-','class'=>'form-control','onchange'=>'function()']
                            ); ?>

                </div>

                <div class="form-group form-material floating" data-plugin="formMaterial">

                <?= $form->field($model, 'branch_id')
                            ->dropDownList(
                                ArrayHelper::map(Branch::find()->all(), 'id', 'title'),
                                 ['prompt'=>'-Select-','class'=>'form-control','onchange'=>'function()']
                            ); ?>

                </div>

                <div class="form-group form-material floating" data-plugin="formMaterial">

                <?= $form->field($model, 'pp_purchase_head_id')
                            ->dropDownList(
                                ArrayHelper::map(PpPurchaseHead::find()->all(), 'id', 'po_order_number'),
                                 ['prompt'=>'-Select-','class'=>'form-control','onchange'=>'function()']
                            ); ?>

                </div>

                <div class="form-group form-material floating" data-plugin="formMaterial">

                <?= $form->field($model, 'supplier_id')
                            ->dropDownList(
                                ArrayHelper::map(Supplier::find()->all(), 'id', 'supplier_code'),
                                 ['prompt'=>'-Select-','class'=>'form-control','onchange'=>'function()']
                            ); ?>

                </div>

                <div class="form-group form-material floating" data-plugin="formMaterial">

                <?= $form->field($model, 'currency_id')
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
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn-primary waves-effect' : 'btn-primary waves-effect']) ?>
    </div>

    <?php ActiveForm::end(); ?>

