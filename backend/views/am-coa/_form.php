<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;
use backend\models\GroupOne;
use backend\models\GroupTwo;
use backend\models\GroupThree;
use backend\models\GroupFour;
use backend\models\Branch;

/* @var $this yii\web\View */
/* @var $model backend\models\AmCoa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="am-coa-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">

        <div class="col-md-6">

            <?= $form->field($model, 'account_code',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'title',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'description',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

            <div class="form-group form-material floating" data-plugin="formMaterial">

                <?= $form->field($model, 'account_type')
                            ->dropDownList(
                                array ('Asset'=>'Asset', 'Liability'=>'Liability','Income' => 'Income','Expenses' => 'Expenses'),
                                array ('prompt'=>'-Select-','class'=>'form-control') 
                            ); ?>

            </div>

            <div class="form-group form-material floating" data-plugin="formMaterial">

                <?= $form->field($model, 'account_usage')
                            ->dropDownList(
                                array ('Ledger'=>'Ledger', 'AP'=>'AP','AR' => 'AR'),
                                array ('prompt'=>'-Select-','class'=>'form-control') 
                            ); ?>

            </div>

            
        </div>

        <div class="col-md-6">

            <div class="form-group form-material floating" data-plugin="formMaterial">

                <?= $form->field($model, 'analyical_code')
                            ->dropDownList(
                                array ('Cash'=>'Cash', 'Non-Cash'=>'Non-Cash','Cheque' => 'Cheque','Bankers Draft'=>'Bankers Draft','Wire Transfer'=>'Wire Transfer','Letter of Credit'=>'Letter of Credit','Others'=>'Others'),
                                array ('prompt'=>'-Select-','class'=>'form-control') 
                            ); ?>

            </div>


            <div class="form-group form-material floating" data-plugin="formMaterial">

                <?= $form->field($model, 'group_one_id')
                            ->dropDownList(
                                ArrayHelper::map(GroupOne::find()->all(), 'id', 'title'),
                                 ['prompt'=>'-Select-','class'=>'form-control']
                            ); ?>

            </div>

            <div class="form-group form-material floating" data-plugin="formMaterial">

                <?= $form->field($model, 'group_two_id')
                            ->dropDownList(
                                ArrayHelper::map(GroupTwo::find()->all(), 'id', 'title'),
                                 ['prompt'=>'-Select-','class'=>'form-control']
                            ); ?>

            </div>

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
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Save Changes') : Yii::t('app', 'Save Changes'), ['class' => $model->isNewRecord ? 'btn btn-primary waves-effect' : 'btn btn-primary waves-effect']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
