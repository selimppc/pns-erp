<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;
use backend\models\GroupTwo;

/* @var $this yii\web\View */
/* @var $model backend\models\GroupThree */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="group-three-form">

    <?php $form = ActiveForm::begin(); ?>


    <div class="form-group form-material" data-plugin="formMaterial">

		<?= $form->field($model, 'group_two_id')
	                ->dropDownList(
	                    ArrayHelper::map(GroupTwo::find()->all(), 'id', 'title'),
	                     ['prompt'=>'-Select-','class'=>'form-control']
	                ); ?>

    </div>

    <?= $form->field($model, 'title',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textarea(['rows' => 6]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-primary waves-effect' : 'btn btn-primary waves-effect']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
