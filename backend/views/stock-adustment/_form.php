<?php

use yii\helpers\Html;
use yii\helpers\Url;
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
         <?= $form->field($modelAdjustmentHead, 'transaction_no',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true,'readonly' => 1]) ?>
        </div>

        <div class="col-md-2">
            <div class="form-group form-material floating" data-plugin="formMaterial">
                <?php

                echo $form->field($modelAdjustmentHead, 'date')->widget(DatePicker::classname(), [
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

                echo $form->field($modelAdjustmentHead, 'confirm_date')->widget(DatePicker::classname(), [
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

                <?= $form->field($modelAdjustmentHead, 'branch_id')
                            ->dropDownList(
                                ArrayHelper::map(Branch::find()->all(), 'id', 'branch_code'),
                                 ['prompt'=>'-Select-','class'=>'form-control']
                            ); ?>

            </div>

        </div>

        <div class="col-md-2">

            <div class="form-group form-material floating" data-plugin="formMaterial">

                <?= $form->field($modelAdjustmentHead, 'type')
                            ->dropDownList(
                                array ('positive'=>'Positive', 'negative'=>'Negative'),
                                array ('class'=>'form-control') 
                            ); ?>

            </div>

        </div>

        <div class="col-md-2">

            <div class="form-group form-material floating" data-plugin="formMaterial">

                <?= $form->field($modelAdjustmentHead, 'currency_id')
                            ->dropDownList(
                                ArrayHelper::map(Currency::find()->all(), 'id', 'currency_code'),
                                 ['prompt'=>'-Select-','class'=>'form-control']
                            ); ?>

            </div>

        </div>

        <div class="col-md-2">

            <?= $form->field($modelAdjustmentHead, 'exchange_rate',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

        </div>

        <div class="col-md-2">
            <?= $form->field($modelAdjustmentHead, 'status',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true,'readonly' => 1]) ?>
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
        'model' => $modelsAdjustmentDetail[0],
        'formId' => 'dynamic-form',
        'formFields' => [
            'product_id'
        ],
    ]); 
    ?>

        <div class="panel panel-default">

            <div class="panel-heading">
                <i class="fa fa-envelope"></i> Stock Adjustment Details
                
                <div class="clearfix"></div>
            </div>

            <div class="panel-body container-items"><!-- widgetContainer -->

                <div style="width: 100%;display: inline-block;">
                    
                    <div class="col-md-2">
                        <label class="control-label only-label" for="">Product</label>
                    </div>

                    <div class="col-md-2">
                        <label class="control-label only-label" for="">Batch Number</label>
                    </div>

                    <div class="col-md-2">
                        <label class="control-label only-label" for="">Expire Date</label>
                    </div>

                    <div class="col-md-2">
                        <label class="control-label only-label" for="">UOM</label>
                    </div>

                    <div class="col-md-2">
                        <label class="control-label only-label" for="">Quantity</label>
                    </div>

                    <div class="col-md-2">
                        <label class="control-label only-label" for="">Stock Rate</label>
                    </div>
                    

                </div>

               <?php foreach ($modelsAdjustmentDetail as $index => $modelAdjustmentDetail): ?>

                    <div class="item"><!-- widgetBody -->

                        <button type="button" class="pull-right remove-item btn-danger btn-xs"><i class="icon md-close" aria-hidden="true"></i> Remove</button>
                        <?php
                            // necessary for update action.
                            if (!$modelAdjustmentDetail->isNewRecord) {
                                echo Html::activeHiddenInput($modelAdjustmentDetail, "[{$index}]id");
                            }
                        ?>

                        <div class="row">

                            <div class="col-md-2">
                                <div class="form-group form-material floating" data-plugin="formMaterial">

                                    <?= $form->field($modelAdjustmentDetail, "[{$index}]product_id")
                                                ->dropDownList(
                                                    ArrayHelper::map(Product::find()->all(), 'id', 'title'),
                                                     ['prompt'=>'-Select-','class'=>'form-control']
                                                )->label(false); ?>

                                </div>
                            </div>

                            <div class="col-md-2">
                                <?= $form->field($modelAdjustmentDetail,"[{$index}]batch_number", ['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true])->label(false) ?>
                            </div>

                            <div class="col-md-2">
                                <?= $form->field($modelAdjustmentDetail,"[{$index}]expire_date", ['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->widget(DatePicker::classname(), [
                                    'value' => date('Y-m-d'),
                                    'options' => [
                                        'placeholder' => 'Enter Date ...',
                                        'value' => date('Y-m-d') ,
                                    ],
                                    'pluginOptions' => [
                                        'autoclose'=>true,
                                        'format' => 'yyyy-m-dd',
                                        'todayHighlight' => true
                                    ]
                                ])->label(false) ?>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group form-material floating" data-plugin="formMaterial">

                                    <?= $form->field($modelAdjustmentDetail, "[{$index}]uom")
                                                ->dropDownList(
                                                    ArrayHelper::map(CodesParam::find()->where(['type' => 'Unit Of Measurement'])->all(), 'id', 'title'),
                                                     ['prompt'=>'-Select-','class'=>'form-control']
                                                )->label(false); ?>

                                </div>
                            </div>

                            <div class="col-md-2">
                                <?= $form->field($modelAdjustmentDetail,"[{$index}]quantity", ['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true])->label(false) ?>
                            </div>

                            <div class="col-md-2">
                                <?= $form->field($modelAdjustmentDetail,"[{$index}]stock_rate", ['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true])->label(false) ?>
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

    <?= Html::submitButton($modelAdjustmentDetail->isNewRecord ? 'Save Changes' : 'Save Changes', ['class' => 'btn btn-primary']) ?>

<?php ActiveForm::end(); ?>

<?php
    
    $this->registerJs("

        $('#imadjusthead-currency_id').change(function (e) {
            var currency = $('#imadjusthead-currency_id').val();

            $.ajax({
                type : 'POST',
                dataType : 'json',
                url : '".Url::toRoute('currency/find-currency-rate')."',
                data: {currency:currency},
                beforeSend : function( request ){
                    
                },
                success : function( data )
                    {   
                        if(data.result == 'success'){                            
                            $('#imadjusthead-exchange_rate').val(data.exchange_rate);
                        }
                    }
            });

        });

     ", yii\web\View::POS_READY, "exchange_rate_change_based_on_currency");   
?>