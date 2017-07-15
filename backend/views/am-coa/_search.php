<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AmCoaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="am-coa-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'account_code') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'account_type') ?>

    <?php // echo $form->field($model, 'account_usage') ?>

    <?php // echo $form->field($model, 'group_one_id') ?>

    <?php // echo $form->field($model, 'group_two_id') ?>

    <?php // echo $form->field($model, 'group_three_id') ?>

    <?php // echo $form->field($model, 'group_four_id') ?>

    <?php // echo $form->field($model, 'analyical_code') ?>

    <?php // echo $form->field($model, 'branch_id') ?>

    <?php // echo $form->field($model, 'status') ?>

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
