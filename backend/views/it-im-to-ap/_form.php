<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;
use backend\models\AmCoa;
/* @var $this yii\web\View */
/* @var $model backend\models\ItImToAp */
/* @var $form yii\widgets\ActiveForm */
?>

    <?php $form = ActiveForm::begin(); ?>

        <div class="row">

            <div class="col-md-6">

                <?= $form->field($model, 'item_group')->textInput(['maxlength' => true]) ?>

                <div class="form-group form-material floating" data-plugin="formMaterial">

                    <?= $form->field($model, 'dr_coa_id')
                                ->dropDownList(
                                    ArrayHelper::map(AmCoa::find()->all(), 'id', 'title'),
                                     ['prompt'=>'-Select-','class'=>'form-control','onchange'=>'function()']
                                ); ?>

                </div>

             

            </div>

            <div class="col-md-6">

                <?= $form->field($model, 'sub_group')->textInput(['maxlength' => true]) ?>

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
