<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;
use backend\models\Product;
use backend\models\PpPurchaseHead;
use backend\models\CodesParam;

/* @var $this yii\web\View */
/* @var $model backend\models\PpPurchaseDetail */
/* @var $form yii\widgets\ActiveForm */
?>
    <?php $form = ActiveForm::begin(); ?>

    <div class="row">

        <div class="col-md-6">

            <div class="form-group form-material floating" data-plugin="formMaterial">

                <?= $form->field($model, 'pp_purchase_head_id')
                            ->dropDownList(
                                ArrayHelper::map(PpPurchaseHead::find()->all(), 'id', 'po_order_number'),
                                 ['prompt'=>'-Select-','class'=>'form-control','onchange'=>'function()']
                            ); ?>

            </div>

            <?= $form->field($model, 'quantity',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'grn_quantity',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?> 

            <div class="form-group form-material floating" data-plugin="formMaterial">

            <?= $form->field($model, 'uom')
                        ->dropDownList(
                            ArrayHelper::map(CodesParam::find()->where(['type'=>'Unit Of Measurement'])->all(), 'id', 'title'),
                             ['prompt'=>'-Select-','class'=>'form-control floating']
                        ); ?>

            </div>           

            <?= $form->field($model, 'uom_quantity',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'unit_quantity',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

        </div>

        <div class="col-md-6">

            <div class="form-group form-material floating" data-plugin="formMaterial">

                <?= $form->field($model, 'product_id')
                            ->dropDownList(
                                ArrayHelper::map(Product::find()->all(), 'id', 'title'),
                                 ['prompt'=>'-Select-','class'=>'form-control','onchange'=>'function()']
                            ); ?>

            </div>  

            <?= $form->field($model, 'tax_rate',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'tax_amount',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'row_amount',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'purchase_rate',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

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


