<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'product_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'image')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'thumb_image')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'class')->textInput() ?>

    <?= $form->field($model, 'group')->textInput() ?>

    <?= $form->field($model, 'category')->textInput() ?>

    <?= $form->field($model, 'currency_id')->textInput() ?>

    <?= $form->field($model, 'model')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'size')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'origin')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'exchange_rate')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sell_rate')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cost_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sell_uom')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sell_uom_qty')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'purchase_uom')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'purchase_uom_qty')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sell_tax')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'stock_uom')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'stock_uom_qty')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pack_size')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'stock_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'generic')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'supplier_id')->textInput() ?>

    <?= $form->field($model, 'manufacture_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'max_level')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'min_level')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 're_order')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
