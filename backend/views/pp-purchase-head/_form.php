<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;

use yii\helpers\ArrayHelper;
use backend\models\Supplier;
use backend\models\Branch;


/* @var $this yii\web\View */
/* @var $model backend\models\PpPurchaseHead */
/* @var $form yii\widgets\ActiveForm */


$js = '
jQuery(".dynamicform_wrapper").on("afterInsert", function(e, item) {
    jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {
        jQuery(this).html("Address: " + (index + 1))
    });
});

jQuery(".dynamicform_wrapper").on("afterDelete", function(e) {
    jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {
        jQuery(this).html("Address: " + (index + 1))
    });
});
';

$this->registerJs($js);

?>

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>


         <?= $form->field($modelPurchaseHead, 'po_order_number')->textInput(['maxlength' => true]) ?>

         <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 4, // the maximum times, an element can be cloned (default 999)
                'min' => 0, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modelsPurchaseDetail[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'product_id',
                ],
            ]); 
        ?>

            <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-envelope"></i> Address Book
            <button type="button" class="pull-right add-item btn btn-success btn-xs"><i class="fa fa-plus"></i> Add address</button>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body container-items"><!-- widgetContainer -->
            <?php foreach ($modelsPurchaseDetail as $index => $modelPurchaseDetail): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <span class="panel-title-address">Address: <?= ($index + 1) ?></span>
                        <button type="button" class="pull-right remove-item btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (!$modelPurchaseDetail->isNewRecord) {
                                echo Html::activeHiddenInput($modelPurchaseDetail, "[{$index}]id");
                            }
                        ?>
                        <?= $form->field($modelPurchaseDetail, "[{$index}]product_id")->textInput(['maxlength' => true]) ?>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>


       <?php DynamicFormWidget::end(); ?>


        <?= Html::submitButton($modelPurchaseDetail->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-primary']) ?>



    <?php ActiveForm::end(); ?>
