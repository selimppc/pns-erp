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
use backend\models\Customer;
use kartik\date\DatePicker;

use kartik\select2\Select2;


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
            <?= $form->field($modelSmHead, 'sm_number',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true,'readonly' => 1]) ?>
        </div>

        <div class="col-md-2">
            <div class="form-group form-material floating" data-plugin="formMaterial">
                <?php

                echo $form->field($modelSmHead, 'date')->widget(DatePicker::classname(), [
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

                <?= $form->field($modelSmHead, 'customer_id')
                            ->dropDownList(
                                ArrayHelper::map(Customer::find()->where(['status'=>'active'])->all(), 'id', 'name'),
                                 ['prompt'=>'-Select-','class'=>'form-control']
                            ); ?>

            </div>

        </div>

        <div class="col-md-2">

            <div class="form-group form-material" data-plugin="formMaterial">

                <?= $form->field($modelSmHead, 'doc_type')
                            ->dropDownList(
                                array ('sales'=>'Sales', 'return'=>'Return', 'receipt' => 'Receipt'),
                               ['prompt'=>'-Select-','class'=>'form-control']
                            ); ?>

            </div>

        </div>


        <div class="col-md-2">

            <div class="form-group form-material floating" data-plugin="formMaterial">

                <?= $form->field($modelSmHead, 'currency_id')
                            ->dropDownList(
                                ArrayHelper::map(Currency::find()->where(['status'=>'active'])->all(), 'id', 'currency_code'),
                                 ['prompt'=>'-Select-','class'=>'form-control']
                            ); ?>

            </div>

        </div>

        <div class="col-md-2">

            <?= $form->field($modelSmHead, 'exchange_rate',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

        </div>

        <div class="col-md-2">

            <div class="form-group form-material floating" data-plugin="formMaterial">

                <?= $form->field($modelSmHead, 'branch_id')
                            ->dropDownList(
                                ArrayHelper::map(Branch::find()->where(['status'=>'active'])->all(), 'id', 'branch_code'),
                                 ['prompt'=>'-Select-','class'=>'form-control']
                            ); ?>

            </div>

        </div>

        <div class="col-md-2">

            <?= $form->field($modelSmHead, 'discount_rate',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

        </div>

        <div class="col-md-2">

            <?= $form->field($modelSmHead, 'discount_amount',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

        </div>

    </div>


    <?php DynamicFormWidget::begin([
            'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
            'widgetBody' => '.container-items', // required: css class selector
            'widgetItem' => '.item', // required: css class
            'limit' => 50, // the maximum times, an element can be cloned (default 999)
            'min' => 1, // 0 or 1 (default 1)
            'insertButton' => '.add-item', // css class
            'deleteButton' => '.remove-item', // css class
            'model' => $modelsSmDetail[0],
            'formId' => 'dynamic-form',
            'formFields' => [
                'product_id',
                'rate',
                'quantity',
                'uom',
                'total'
            ],
        ]); 
    ?>

        <div class="panel panel-default">

            <div class="panel-heading">
                <i class="fa fa-envelope"></i> Item Details                
                <div class="clearfix"></div>
            </div>

            <div class="panel-body container-items"><!-- widgetContainer -->

                <div style="width: 100%;display: inline-block;">
                    <div class="custom-column-37">
                        <label class="control-label only-label" for="">Product</label>
                    </div>                    
                    <div class="custom-column-15">
                        <label class="control-label only-label" for="">Sell Rate</label>
                    </div>                    
                    <div class="custom-column-15">
                        <label class="control-label only-label" for="">Quantity</label>
                    </div>                    
                    <div class="custom-column-15">
                        <label class="control-label only-label" for="">UOM</label>
                    </div>                    
                    <div class="custom-column-15">
                        <label class="control-label only-label" for="">Total</label>
                    </div>                    
                </div>

                <?php foreach ($modelsSmDetail as $index => $modelSmDetail): ?>

                    <div class="item"><!-- widgetBody -->

                        <button type="button" class="pull-right remove-item btn-danger btn-xs"><i class="icon md-close" aria-hidden="true"></i> Remove</button>
                        <?php
                            // necessary for update action.
                            if (!$modelSmDetail->isNewRecord) {
                                echo Html::activeHiddenInput($modelSmDetail, "[{$index}]id");
                            }
                        ?>

                        <div class="row">

                            <div class="custom-column-40">
                                <div class="form-group form-material floating" data-plugin="formMaterial">

                                    <?php

                                        echo $form->field($modelSmDetail, "[{$index}]product_id")->widget(Select2::classname(), [
                                            'data' => Product::get_product_list(),
                                            'language' => '',
                                            'options' => ['placeholder' => 'Select a product ...'],
                                            'pluginOptions' => [
                                                'allowClear' => true,
                                                'classs' => 'form-group form-material floating',
                                                'data-plugin' => 'formMaterial'
                                            ],
                                            /*'pluginEvents' => [
                                               'change' => 'function() { 
                                                   
                                                }',
                                            ],*/
                                        ])->label(false);

                                    ?>

                                    

                                </div>
                            </div>

                            <div class="custom-column-15">
                                <?= $form->field($modelSmDetail, "[{$index}]rate", ['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true])->label(false) ?>
                            </div>

                            <div class="custom-column-15">
                                <?= $form->field($modelSmDetail, "[{$index}]quantity", ['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true])->label(false) ?>
                            </div>

                            <div class="custom-column-15">
                            

                                <?= $form->field($modelSmDetail, "[{$index}]uom", ['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->dropDownList(
                                        ArrayHelper::map(CodesParam::find()->where(['type'=>'Unit Of Measurement'])->andWhere(['status'=>'active'])->all(), 'id', 'title'),
                                         ['prompt'=>'-Select-','class'=>'form-control floating']
                                    )->label(false) ?>
                            </div>
                            
                             <div class="custom-column-15">
                                <?= $form->field($modelSmDetail, "[{$index}]total", ['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true])->label(false) ?>
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


     <?= Html::submitButton($modelSmDetail->isNewRecord ? 'Save Changes' : 'Save Changes', ['class' => 'btn btn-primary']) ?>

<?php ActiveForm::end(); ?>


<?php
    
    $this->registerJs("

        $('#smhead-currency_id').change(function (e) {
            var currency = $('#smhead-currency_id').val();

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
                            $('#smhead-exchange_rate').val(data.exchange_rate);
                        }
                    }
            });

        });

        window.initSelect2Loading = function(id, optVar){
            initS2Loading(id, optVar)
        };
        window.initSelect2DropStyle = function(id, kvClose, ev){
            initS2Loading(id, kvClose, ev)
        };

        $('.dynamicform_wrapper').on('afterInsert', function(e, item) {
            
        });


        $('#smhead-discount_rate').change(function (e) {
            var discount_rate = $('#smhead-discount_rate').val();
            if(discount_rate > 0.00){
                $('#smhead-discount_amount').prop('readonly', true);
            }
        });

        $('#smhead-discount_amount').change(function (e) {
            var discount_amount = $('#smhead-discount_amount').val();
            if(discount_amount > 0.00){
                $('#smhead-discount_rate').prop('readonly', true);
            }
        });

     ", yii\web\View::POS_READY, "exchange_rate_change_based_on_currency");   
?>