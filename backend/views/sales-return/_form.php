<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;

use yii\bootstrap\Modal;

use yii\helpers\ArrayHelper;
use backend\models\Supplier;
use backend\models\Branch;
use backend\models\Currency;
use backend\models\Product;
use backend\models\CodesParam;
use backend\models\Customer;
use backend\models\SalesPerson;
use kartik\date\DatePicker;

use backend\models\VwImStockView;

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

            <?= $form->field($modelSmHead, 'note',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

        </div>

        <div class="col-md-2">
            <div class="form-group form-material floating" data-plugin="formMaterial">

                <?= $form->field($modelSmHead, 'date',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true,'readonly' => 1]) ?>
               
            </div>
        </div>

        <div class="col-md-2">

            <div class="form-group form-material" data-plugin="formMaterial">

                <?= $form->field($modelSmHead, 'pay_terms')
                            ->dropDownList(
                                array ('Cash'=>'Cash', 'Credit' => 'Credit'),
                                [
                                    'class'=>'form-control',
                                    'disabled' => 'disabled'
                                ]

                            ); ?>

                <?= $form->field($modelSmHead, 'doc_type')->hiddenInput(['value'=>'sales'])->label(false); ?>            

            </div>

        </div>


        <div class="col-md-2">

            <div class="form-group form-material floating" data-plugin="formMaterial">

                <?= $form->field($modelSmHead, 'currency_id')
                            ->dropDownList(
                                ArrayHelper::map(Currency::find()->where(['status'=>'active'])->all(), 'id', 'currency_code'),
                                 ['prompt'=>'-Select-','class'=>'form-control','disabled' => 'disabled']
                            ); ?>

            </div>

        </div>

        <div class="col-md-2">

            <?= $form->field($modelSmHead, 'exchange_rate',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true, 'readonly' => 1]) ?>

        </div>

        <div class="col-md-2">

            <?= $form->field($modelSmHead, 'tax_amount',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true, 'readonly' => 1]) ?>

        </div>

        <div class="col-md-2">

            <div class="form-group form-material floating" data-plugin="formMaterial">

                <?= $form->field($modelSmHead, 'branch_id')
                            ->dropDownList(
                                ArrayHelper::map(Branch::find()->where(['status'=>'active'])->all(), 'id', 'title'),
                                 [
                                    'prompt'=>'-Select-',
                                    'class'=>'form-control',
                                    'disabled' => 'disabled'
                                ]
                            ); ?>

            </div>

        </div>

        <div class="col-md-2">

            <div class="form-group form-material floating" data-plugin="formMaterial">

                <?= $form->field($modelSmHead, 'customer_id')
                            ->dropDownList(
                                ArrayHelper::map(Customer::find()->where(['status'=>'active'])->all(), 'id', 'name'),
                                 [
                                    'prompt'=>'-Select-',
                                    'class'=>'form-control',
                                    'disabled' => 'disabled'
                                ]
                            ); ?>
            </div>

        </div>

        <div class="col-md-2">

            <div class="form-group form-material floating" data-plugin="formMaterial">

                <?= $form->field($modelSmHead, 'sales_person_id')
                            ->dropDownList(
                                ArrayHelper::map(SalesPerson::find()->where(['status'=>'active'])->all(), 'id', 'name'),
                                 [
                                    'prompt'=>'-Select-',
                                    'class'=>'form-control sales_person_class',
                                    'disabled' => 'disabled'
                                ]
                            ); ?>
                <div id="sales_person_data"></div>
                <?=$form->field($modelSmHead, 'commission')->hiddenInput()->label(false);
?>
                
            </div>

        </div>

        <div class="col-md-2">

            <?= $form->field($modelSmHead, 'discount_amount',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true,'readonly' => true]) ?>

        </div>

        

       <!--  <div class="col-md-2">

            <?= $form->field($modelSmHead, 'discount_rate',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

        </div> -->

        

        

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
                'available_quantity',
                'rate',
                'quantity',
                'uom_name',
                'uom',
                'total',
                'actual_sell_rate',
                'batch_number',
                'sell_rate'
            ],
        ]); 
    ?>

        <div class="panel panel-default">

            <div class="panel-heading">
                <i class="fa fa-envelope"></i> Item Details                
                <div class="clearfix"></div>
            </div>

            <div class="panel-body container-items"><!-- widgetContainer -->

                <div class="row">
                    <div class="custom-col-35">
                        <label class="control-label only-label" for="">Product</label>
                    </div>  
                                  
                    <div class="custom-col-10">
                        <label class="control-label only-label" for="">Rate</label>
                    </div>                                        
                    <div class="custom-col-06">
                        <label class="control-label only-label" for="">Qty</label>
                    </div>                    
                    <div class="custom-col-07">
                        <label class="control-label only-label" for="">UOM</label>
                    </div> 
                    <div class="custom-col-10">
                        <label class="control-label only-label" for="">Disc Amt/Qty</label>
                    </div> 
                    <div class="custom-col-10">
                        <label class="control-label only-label" for="">Total Disc</label>
                    </div>                    
                    <div class="custom-col-10">
                        <label class="control-label only-label" for="">Total</label>
                    </div>   
                    <div class="custom-col-05">

                    </div>                 
                </div>

                <?php foreach ($modelsSmDetail as $index => $modelSmDetail):

                        $modelSmDetail->total = number_format(($modelSmDetail->sell_rate * $modelSmDetail->quantity) - $modelSmDetail->total_discount, 3, '.', '') ;

                        $modelSmDetail->uom_name = $modelSmDetail->uom;
                ?>

                    <div class="item"><!-- widgetBody -->

                        
                        <?php
                            // necessary for update action.
                            if (!$modelSmDetail->isNewRecord) {
                                echo Html::activeHiddenInput($modelSmDetail, "[{$index}]id");
                            }
                        ?>

                        <div class="row">

                            <div class="custom-col-35">
                                <div class="form-group form-material floating" data-plugin="formMaterial">

                                    <?php
                                        echo $form->field($modelSmDetail, "[{$index}]product_id")->dropDownList(
                                            VwImStockView::get_product_list_dpends_branch(isset($modelSmHead->branch_id) && !empty($modelSmHead->branch_id)?$modelSmHead->branch_id:''),[
                                                'class' => 'custom-select2 form-control',
                                                'prompt'=>'--Select Product--'
                                            ]
                                            )->label(false);
                                    ?>


                                </div>
                            </div>
  

                            <div class="custom-col-10">
                                <?= $form->field($modelSmDetail, "[{$index}]rate", ['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true,'class' => 'rate_class form-control','readonly' => 1])->label(false) ?>

                                <?= $form->field($modelSmDetail, "[{$index}]actual_sell_rate", ['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->hiddenInput(['maxlength' => true, 'readonly' => true, 'class' => 'actual_sell_rate_class form-control'])->label(false) ?>

                            </div>

                            <div class="custom-col-06">
                                <?= $form->field($modelSmDetail, "[{$index}]quantity", ['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true, 'class' => 'quantity_class form-control'])->label(false) ?>
                            </div>

                            <div class="custom-col-07">

                                <?= $form->field($modelSmDetail, "[{$index}]uom_name", ['options' => ['class' => 'uom_class form-group form-material floating','data-plugin' => 'formMaterial']])->dropDownList(
                                    ArrayHelper::map(CodesParam::find()->where(['type'=>'Unit Of Measurement'])->andWhere(['status'=>'active'])->all(), 'id', 'title'),
                                     ['prompt'=>'-Select-','class'=>'form-control floating uom_class','disabled' => 'disabled']
                                    )->label(false) ?>

                                <?= $form->field($modelSmDetail, "[{$index}]uom", ['options' => ['class' => '','data-plugin' => 'formMaterial']])->hiddenInput(['maxlength' => true, 'readonly' => true, 'class' => 'uom_id_class form-control'])->label(false) ?>
                            </div>

                            <div class="custom-col-10">
                                <?= $form->field($modelSmDetail, "[{$index}]discount_per_product", ['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true, 'readonly' => true, 'class' => 'discount_per_product_class form-control'])->label(false) ?>
                            </div>

                            <div class="custom-col-10">
                                <?= $form->field($modelSmDetail, "[{$index}]total_discount", ['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true, 'readonly' => true, 'class' => 'total_discount_class form-control'])->label(false) ?>
                            </div>
                            
                            <div class="custom-col-10">
                                <?= $form->field($modelSmDetail, "[{$index}]total", ['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true, 'readonly' => true, 'class' => 'total_class form-control'])->label(false) ?>

                                <?= $form->field($modelSmDetail, "[{$index}]batch_number", ['options' => ['class' => '','data-plugin' => 'formMaterial']])->hiddenInput(['maxlength' => true, 'class' => 'batch_number_class form-control'])->label(false) ?>

                                <?= $form->field($modelSmDetail, "[{$index}]sell_rate", ['options' => ['class' => '','data-plugin' => 'formMaterial']])->hiddenInput(['maxlength' => true, 'class' => 'sell_rate_class form-control'])->label(false) ?>
                            </div>

                            

                            <div class="custom-col-05">
                                
                                <button style="border:none;" type="button" class="pull-right remove-item badge badge-danger"> Remove</button>
                                
                            </div>

                        </div>

                    </div>

                <?php endforeach; ?>

            </div>


        </div>
     <?php DynamicFormWidget::end(); ?>


     <?= Html::submitButton($modelSmDetail->isNewRecord ? 'Save Changes' : 'Save Changes', ['class' => 'btn btn-primary']) ?>

<?php ActiveForm::end(); ?>

<?php 
        Modal::begin([
            'header' => 'Product Details',
            'id' => 'modal',
            'size' => 'modal-lg',
        ]);
        echo "<div id='modalContent'></div>";
        Modal::end();
?>

<style type="text/css">
    .form-group .select2{
        width: 100% !important;
    }
</style>

<?php
    
    $this->registerJs("


        $(document).delegate('.quantity_class','change',function(){

            var quantity = $(this).val();
            var item = $(this);

            if(parseInt(quantity) < 1  ){

                alert('Please put valid quantity');
                $(item).closest('.item').find('.total_class').val('');
                $(item).closest('.item').find('.quantity_class').val('');

            }else{

                // calculate total discount

                var discount_per_product = $(item).closest('.item').find('.discount_per_product_class').val();

                var sell_rate = $(item).closest('.item').find('.rate_class').val();

                var actual_sell_rate = $(item).closest('.item').find('.sell_rate_class').val();


                var total_discount = discount_per_product * quantity;    
                

                $(item).closest('.item').find('.total_discount_class').val(parseFloat(Math.round( (total_discount)*100 ) /100 ).toFixed(3));

                var discount_amount = 0;
                $('.total_discount_class').each(function(){
                    var input = $(this).val(); 
                    discount_amount += parseInt( input);
                });

                $('#smhead-discount_amount').val(parseFloat(Math.round( (discount_amount)*100 ) /100 ).toFixed(3));

                var total_amount = actual_sell_rate * quantity - total_discount;

                $(item).closest('.item').find('.total_class').val(parseFloat(Math.round( (total_amount)*100 ) /100 ).toFixed(3));

                



            }

            

        });




     ", yii\web\View::POS_READY, "exchange_rate_change_based_on_currency");   
?>
