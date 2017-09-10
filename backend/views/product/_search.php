<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ProductSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'product_code') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'image') ?>

    <?php // echo $form->field($model, 'thumb_image') ?>

    <?php // echo $form->field($model, 'class') ?>

    <?php // echo $form->field($model, 'group') ?>

    <?php // echo $form->field($model, 'category') ?>

    <?php // echo $form->field($model, 'currency_id') ?>

    <?php // echo $form->field($model, 'model') ?>

    <?php // echo $form->field($model, 'size') ?>

    <?php // echo $form->field($model, 'origin') ?>

    <?php // echo $form->field($model, 'exchange_rate') ?>

    <?php // echo $form->field($model, 'sell_rate') ?>

    <?php // echo $form->field($model, 'cost_price') ?>

    <?php // echo $form->field($model, 'sell_uom') ?>

    <?php // echo $form->field($model, 'sell_uom_qty') ?>

    <?php // echo $form->field($model, 'purchase_uom') ?>

    <?php // echo $form->field($model, 'purchase_uom_qty') ?>

    <?php // echo $form->field($model, 'sell_tax') ?>

    <?php // echo $form->field($model, 'stock_uom') ?>

    <?php // echo $form->field($model, 'stock_uom_qty') ?>

    <?php // echo $form->field($model, 'pack_size') ?>

    <?php // echo $form->field($model, 'stock_type') ?>

    <?php // echo $form->field($model, 'generic') ?>

    <?php // echo $form->field($model, 'supplier_id') ?>

    <?php // echo $form->field($model, 'manufacture_code') ?>

    <?php // echo $form->field($model, 'max_level') ?>

    <?php // echo $form->field($model, 'min_level') ?>

    <?php // echo $form->field($model, 're_order') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
