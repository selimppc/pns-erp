<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;

use yii\helpers\ArrayHelper;
use backend\models\Supplier;
use backend\models\Branch;
use backend\models\Currency;
use backend\models\Product;
use backend\models\CodesParam;
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
         <?= $form->field($modelTransferHead, 'transfer_number',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true,'readonly' => 1]) ?>
        </div>

        <div class="col-md-2">
            <div class="form-group form-material floating" data-plugin="formMaterial">
                <?php

                echo $form->field($modelTransferHead, 'date')->widget(DatePicker::classname(), [
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
                <?php

                echo $form->field($modelTransferHead, 'confirm_date')->widget(DatePicker::classname(), [
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

        <div class="col-md-4">

            <?= $form->field($modelTransferHead, 'note',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

        </div>

        <div class="col-md-2">
            <?= $form->field($modelTransferHead, 'status',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true,'readonly' => 1]) ?>
        </div> 


        <div class="col-md-6">
            <h2 style="background: #FFCCFF;padding: 7px;width: 100%;font-weight: 500;
    border-radius: 5px;font-size: 15px;">Store, from where the stock will transfer</h2>


            <div class="col-md-4">

                <div class="form-group form-material floating" data-plugin="formMaterial">

                    <?= $form->field($modelTransferHead, 'from_branch_id')
                                ->dropDownList(
                                    ArrayHelper::map(Branch::find()->all(), 'id', 'branch_code'),
                                     ['prompt'=>'-Select-','class'=>'form-control']
                                ); ?>

                </div>

            </div>

            <div class="col-md-4">

                <div class="form-group form-material floating" data-plugin="formMaterial">

                    <?= $form->field($modelTransferHead, 'from_currency_id')
                                ->dropDownList(
                                    ArrayHelper::map(Currency::find()->all(), 'id', 'currency_code'),
                                     ['prompt'=>'-Select-','class'=>'form-control']
                                ); ?>

                </div>

            </div>    

            <div class="col-md-4">

                <?= $form->field($modelTransferHead, 'from_exchange_rate',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

            </div>
        </div>


        


        <div class="col-md-6">
            <h2 style="background: #FFCCFF;padding: 7px;width: 100%;font-weight: 500;border-radius: 5px;font-size: 15px;">Store, Where To transfer</h2>

            <div class="col-md-4">

                <div class="form-group form-material floating" data-plugin="formMaterial">

                    <?= $form->field($modelTransferHead, 'to_branch_id')
                                ->dropDownList(
                                    ArrayHelper::map(Branch::find()->all(), 'id', 'branch_code'),
                                     ['prompt'=>'-Select-','class'=>'form-control']
                                ); ?>

                </div>

            </div>

            <div class="col-md-4">

                <div class="form-group form-material floating" data-plugin="formMaterial">

                    <?= $form->field($modelTransferHead, 'to_currency_id')
                                ->dropDownList(
                                    ArrayHelper::map(Currency::find()->all(), 'id', 'currency_code'),
                                     ['prompt'=>'-Select-','class'=>'form-control']
                                ); ?>

                </div>

            </div>    

            <div class="col-md-4">

                <?= $form->field($modelTransferHead, 'to_exchange_rate',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

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
        'model' => $modelsTransferDetail[0],
        'formId' => 'dynamic-form',
        'formFields' => [
            'product_id',
            'uom',
            'quantity',
            'rate'
        ],
    ]); 
    ?>

        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-envelope"></i> Stock Transfer Details
                
                <div class="clearfix"></div>
            </div>

            <div class="panel-body container-items"><!-- widgetContainer -->

                <div style="width: 100%;display: inline-block;">
                    <div class="col-md-2">
                        <label class="control-label only-label" for="">Product</label>
                    </div>
                    <div class="col-md-2">
                        <label class="control-label only-label" for="">Unit of Measurement</label>
                    </div>
                    <div class="col-md-2">
                        <label class="control-label only-label" for="">Quantity</label>
                    </div>
                    <div class="col-md-2">
                        <label class="control-label only-label" for="">Rate</label>
                    </div>
                </div>

                <?php foreach ($modelsTransferDetail as $index => $modelTransferDetail): ?>

                    <div class="item"><!-- widgetBody -->

                        <button type="button" class="pull-right remove-item btn-danger btn-xs"><i class="icon md-close" aria-hidden="true"></i> Remove</button>
                        <?php
                            // necessary for update action.
                            if (!$modelTransferDetail->isNewRecord) {
                                echo Html::activeHiddenInput($modelTransferDetail, "[{$index}]id");
                            }
                        ?>

                        <div class="row">

                            <div class="col-md-2">
                                <div class="form-group form-material floating" data-plugin="formMaterial">

                                    <?= $form->field($modelTransferDetail, "[{$index}]product_id")
                                                ->dropDownList(
                                                    ArrayHelper::map(Product::find()->all(), 'id', 'title'),
                                                     ['prompt'=>'-Select-','class'=>'form-control']
                                                )->label(false); ?>

                                </div>
                            </div>

                            <div class="col-md-2">
                                <?= $form->field($modelTransferDetail, "[{$index}]uom", ['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->dropDownList(
                                    ArrayHelper::map(CodesParam::find()->where(['type'=>'Unit Of Measurement'])->all(), 'id', 'title'),
                                     ['prompt'=>'-Select-','class'=>'form-control floating']
                                )->label(false) ?>
                            </div>

                            <div class="col-md-2">
                                <?= $form->field($modelTransferDetail,"[{$index}]quantity", ['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true])->label(false) ?>
                            </div>

                            <div class="col-md-2">
                                <?= $form->field($modelTransferDetail,"[{$index}]rate", ['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true])->label(false) ?>
                            </div>
                        </div>

                    </div>

                 <?php endforeach; ?>   

            </div>

            <div style="margin-left: 15px;width: 100%;display: inline-block;   margin-bottom: 10px;">
                <button type="button" class="pull-left add-item btn btn-success btn-xs"><i class="icon md-plus" aria-hidden="true"></i> Add more </button>
            </div>  

        </div>

    <?php DynamicFormWidget::end(); ?>

    <?= Html::submitButton($modelTransferDetail->isNewRecord ? 'Save Changes' : 'Save Changes', ['class' => 'btn btn-primary']) ?>

<?php ActiveForm::end(); ?>