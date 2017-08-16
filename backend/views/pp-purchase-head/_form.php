<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;

use yii\helpers\ArrayHelper;
use backend\models\Supplier;
use backend\models\Branch;
use backend\models\Product;
use kartik\date\DatePicker;


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

        <div class="row">
            <div class="col-md-2">
             <?= $form->field($modelPurchaseHead, 'po_order_number',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true,'readonly' => 1]) ?>
            </div> 

            <div class="col-md-2">
                <div class="form-group form-material floating" data-plugin="formMaterial">
                    <?php

                    echo $form->field($modelPurchaseHead, 'date')->widget(DatePicker::classname(), [
                            'value' => date('Y-m-d'),
                            'options' => [
                                'placeholder' => 'Enter Date ...',
                                'value' => date('Y-m-d'),
                            ],
                            'pluginOptions' => [
                                'autoclose'=>true,
                                'format' => 'yyyy-m-dd',
                                'todayHighlight' => true
                            ]
                        ]);

                        
                    ?>
                </div>
            </div>

            <div class="col-md-2">

                <div class="form-group form-material floating" data-plugin="formMaterial">

                    <?= $form->field($modelPurchaseHead, 'supplier_id')
                                ->dropDownList(
                                    ArrayHelper::map(Supplier::find()->all(), 'id', 'supplier_code'),
                                     ['prompt'=>'-Select-','class'=>'form-control']
                                ); ?>

                </div>

            </div>

            <div class="col-md-2">

                <div class="form-group form-material" data-plugin="formMaterial">

                    <?= $form->field($modelPurchaseHead, 'pay_terms')
                                ->dropDownList(
                                    array ('Cash'=>'Cash', 'Credit'=>'Credit'),
                                    array ('class'=>'form-control') 
                                ); ?>

                </div>

            </div>

            <div class="col-md-2">
                <div class="form-group form-material floating" data-plugin="formMaterial">
                    <?php

                    echo $form->field($modelPurchaseHead, 'delivery_date')->widget(DatePicker::classname(), [
                            'value' => date('Y-m-d'),
                            'options' => [
                                'placeholder' => 'Enter Date ...',
                                'value' => date('Y-m-d',strtotime('+1 days')) ,
                            ],
                            'pluginOptions' => [
                                'autoclose'=>true,
                                'format' => 'yyyy-m-dd',
                                'todayHighlight' => true
                            ]
                        ]);

                        
                    ?>
                </div>
            </div>

            <div class="col-md-2">

                <div class="form-group form-material floating" data-plugin="formMaterial">

                    <?= $form->field($modelPurchaseHead, 'branch_id')
                                ->dropDownList(
                                    ArrayHelper::map(Branch::find()->all(), 'id', 'branch_code'),
                                     ['prompt'=>'-Select-','class'=>'form-control']
                                ); ?>

                </div>

            </div>

            



        </div>

         <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 10, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modelsPurchaseDetail[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'product_id',
                    'quantity',
                    'uom',
                    'uom_quantity',
                    'purchase_rate'
                ],
            ]); 
        ?>

            <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-envelope"></i> Purchase Order Details
            <button type="button" class="pull-right add-item btn btn-success btn-xs"><i class="icon md-plus" aria-hidden="true"></i> </button>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body container-items"><!-- widgetContainer -->
            <?php foreach ($modelsPurchaseDetail as $index => $modelPurchaseDetail): ?>
                <div class="item"><!-- widgetBody -->

                     <button type="button" class="pull-right remove-item btn-danger btn-xs"><i class="icon md-close" aria-hidden="true"></i></button>
                    <?php
                        // necessary for update action.
                        if (!$modelPurchaseDetail->isNewRecord) {
                            echo Html::activeHiddenInput($modelPurchaseDetail, "[{$index}]id");
                        }
                    ?>
                    <div class="row">

                        <div class="col-md-2">
                            <div class="form-group form-material floating" data-plugin="formMaterial">

                                <?= $form->field($modelPurchaseDetail, "[{$index}]product_id")
                                            ->dropDownList(
                                                ArrayHelper::map(Product::find()->all(), 'id', 'title'),
                                                 ['prompt'=>'-Select-','class'=>'form-control']
                                            ); ?>

                            </div>
                        </div>

                        <div class="col-md-2">
                            <?= $form->field($modelPurchaseDetail,"[{$index}]quantity", ['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>
                        </div>

                        <div class="col-md-2">
                            <?= $form->field($modelPurchaseDetail, "[{$index}]uom", ['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>
                        </div>

                        <div class="col-md-2">
                            <?= $form->field($modelPurchaseDetail, "[{$index}]uom_quantity", ['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>
                        </div>

                        <div class="col-md-2">
                            <?= $form->field($modelPurchaseDetail, "[{$index}]purchase_rate", ['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>
                        </div>

                        

                    </div>

                </div>
            <?php endforeach; ?>
        </div>
    </div>


       <?php DynamicFormWidget::end(); ?>


        <?= Html::submitButton($modelPurchaseDetail->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-primary']) ?>



    <?php ActiveForm::end(); ?>
