<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use backend\models\CodesParam;

/* @var $this yii\web\View */
/* @var $model backend\models\Supplier */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="supplier-form form-two-column">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">

        <div class="col-md-6">

            <?= $form->field($model, 'supplier_code',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true, 'readonly' => 1]) ?>

            <?= $form->field($model, 'group')
                        ->dropDownList(
                            ArrayHelper::map(CodesParam::find()->where(['type'=>'Supplier Group'])->andWhere(['status'=>'active'])->all(), 'id', 'title'),
                             ['prompt'=>'-Select-','class'=>'form-control floating']
                        ); ?>

            <?= $form->field($model, 'contct_person',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'phone',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'fax',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'cell',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'email',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

        </div>

        <div class="col-md-6">

            <?= $form->field($model, 'org_name',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'address',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'state',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'zip',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

             <?= $form->field($model, 'web_url',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

            <div class="form-group form-material" data-plugin="formMaterial">

                <?= $form->field($model, 'status')
                            ->dropDownList(
                                array ('active'=>'Active', 'inactive'=>'Inactive','cancel' => 'Cancel'),
                                array ('class'=>'form-control') 
                            ); ?>

            </div>

        </div>

    </div>

    

   

    

    

    

    

    

   

    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Save Changes') : Yii::t('app', 'Save Changes'), ['class' => $model->isNewRecord ? 'btn btn-primary waves-effect pull-right' : 'btn btn-primary waves-effect pull-right']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
