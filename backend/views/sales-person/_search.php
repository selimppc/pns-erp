<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SalesPersonSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sales-person-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'sales_person_code') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'api_id') ?>

    <?= $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'terotorry') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'cell') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'fax') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'branch_id') ?>

    <?php // echo $form->field($model, 'market') ?>

    <?php // echo $form->field($model, 'credit_limit') ?>

    <?php // echo $form->field($model, 'hub') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
