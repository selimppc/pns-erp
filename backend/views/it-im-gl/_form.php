<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;
use backend\models\Branch;
use backend\models\AmCoa;

/* @var $this yii\web\View */
/* @var $model backend\models\ItImGl */
/* @var $form yii\widgets\ActiveForm */
?>

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">

        <div class="col-md-6">

            <div class="form-group form-material floating" data-plugin="formMaterial">

                <?= $form->field($model, 'branch_id')
                            ->dropDownList(
                                ArrayHelper::map(Branch::find()->all(), 'id', 'title'),
                                 ['prompt'=>'-Select-','class'=>'form-control','onchange'=>'function()']
                            ); ?>

            </div>

            <?= $form->field($model, 'transaction_code')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'group')->textInput(['maxlength' => true]) ?>

        </div>

        <div class="col-md-6">

            <div class="form-group form-material floating" data-plugin="formMaterial">

                <?= $form->field($model, 'dr_coa_id')
                            ->dropDownList(
                                ArrayHelper::map(AmCoa::find()->all(), 'id', 'title'),
                                 ['prompt'=>'-Select-','class'=>'form-control','onchange'=>'function()']
                            ); ?>

            </div>

            <div class="form-group form-material floating" data-plugin="formMaterial">

                <?= $form->field($model, 'cr_coa_id')
                            ->dropDownList(
                                ArrayHelper::map(AmCoa::find()->all(), 'id', 'title'),
                                 ['prompt'=>'-Select-','class'=>'form-control','onchange'=>'function()']
                            ); ?>

            </div>

        </div>

    </div>    

    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary waves-effect' : 'btn btn-primary waves-effect']) ?>
    </div>

    <?php ActiveForm::end(); ?>

