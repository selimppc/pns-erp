<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;

use backend\models\Branch;

/* @var $this yii\web\View */
/* @var $model backend\models\SalesPerson */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sales-person-form form-two-column">

    <?php $form = ActiveForm::begin(); ?>

        <div class="row">

            <div class="col-md-6">

                <?= $form->field($model, 'employer_code',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true, 'readonly' => 1]) ?>

                <?= $form->field($model, 'terotorry',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'type',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

                <div class="form-group form-material floating" data-plugin="formMaterial">

                    <?= $form->field($model, 'branch_id')
                                ->dropDownList(
                                    ArrayHelper::map(Branch::find()->where(['status'=>'active'])->all(), 'id', 'title'),
                                     ['prompt'=>'-Select-','class'=>'form-control']
                                ); ?>

                </div>

                <?= $form->field($model, 'market',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'credit_limit',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'hub',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

                <div class="form-group form-material" data-plugin="formMaterial">

                    <?= $form->field($model, 'status')
                                ->dropDownList(
                                    array ('active'=>'Active', 'inactive'=>'Inactive','cancel' => 'Cancel'),
                                    array ('class'=>'form-control') 
                                ); ?>

                </div>

               

            </div>

            <div class="col-md-6">

                <?= $form->field($model, 'name',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'address',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'cell',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'phone',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'fax',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'email',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

            </div>



        </div>
        

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Save Changes') : Yii::t('app', 'Save Changes'), ['class' => $model->isNewRecord ? 'btn btn-primary waves-effect pull-right' : 'btn btn-primary waves-effect pull-right']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>
