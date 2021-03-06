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
                <?php

                echo $form->field($modelSmHead, 'date')->widget(DatePicker::classname(), [
                        'value' => date('Y-m-d'),
                        'options' => [
                            'placeholder' => 'Enter Date ...',
                            'value' => !empty($modelSmHead->date)?$modelSmHead->date:date('Y-m-d'),
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

            <div class="form-group form-material" data-plugin="formMaterial">

                <?= $form->field($modelSmHead, 'pay_terms')
                            ->dropDownList(
                                array ('Cash'=>'Cash', 'Credit' => 'Credit'),
                               ['class'=>'form-control']
                            ); ?>

                <?= $form->field($modelSmHead, 'doc_type')->hiddenInput(['value'=>'sales'])->label(false); ?>            

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

            <?= $form->field($modelSmHead, 'tax_amount',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

        </div>

        <div class="col-md-2">

            <div class="form-group form-material floating" data-plugin="formMaterial">

                <?= $form->field($modelSmHead, 'branch_id')
                            ->dropDownList(
                                ArrayHelper::map(Branch::find()->where(['status'=>'active'])->all(), 'id', 'title'),
                                 ['prompt'=>'-Select-','class'=>'form-control']
                            ); ?>

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

            <div class="form-group form-material floating" data-plugin="formMaterial">

                <?= $form->field($modelSmHead, 'sales_person_id')
                            ->dropDownList(
                                ArrayHelper::map(SalesPerson::find()->where(['status'=>'active'])->all(), 'id', 'name'),
                                 ['prompt'=>'-Select-','class'=>'form-control sales_person_class']
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
                    <div class="custom-col-05"></div>    
                    <div class="custom-col-06">
                        <label class="control-label only-label" for="">Aval Qty</label>
                    </div>               
                    <div class="custom-col-08">
                        <label class="control-label only-label" for="">Rate</label>
                    </div>                                        
                    <div class="custom-col-06">
                        <label class="control-label only-label" for="">Qty</label>
                    </div>                    
                    <div class="custom-col-07">
                        <label class="control-label only-label" for="">UOM</label>
                    </div> 
                    <div class="custom-col-08">
                        <label class="control-label only-label" for="">Disc Amt/Qty</label>
                    </div> 
                    <div class="custom-col-08">
                        <label class="control-label only-label" for="">Total Disc</label>
                    </div>                    
                    <div class="custom-col-08">
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

                            <div class="custom-col-05">
                                <a href="#" class="modalButton badge badge-primary details_class">Details</a>
                            </div>    

                            <div class="custom-col-06">
                                <?= $form->field($modelSmDetail, "[{$index}]available_quantity", ['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true,'readonly' => true, 'class' => 'available_quantity_class form-control'])->label(false) ?>
                            </div>

                            <div class="custom-col-08">
                                <?= $form->field($modelSmDetail, "[{$index}]rate", ['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true,'class' => 'rate_class form-control'])->label(false) ?>

                                <div class="actual-sell-rate-show"></div>

                                <?= $form->field($modelSmDetail, "[{$index}]actual_sell_rate", ['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->hiddenInput(['maxlength' => true, 'readonly' => true, 'class' => 'actual_sell_rate_class form-control'])->label(false) ?>

                            </div>

                            <div class="custom-col-06">
                                <?= $form->field($modelSmDetail, "[{$index}]quantity", ['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true, 'class' => 'quantity_class form-control'])->label(false) ?>
                            </div>

                            <div class="custom-col-07">

                                <?= $form->field($modelSmDetail, "[{$index}]uom_name", ['options' => ['class' => 'uom_class form-group form-material floating','data-plugin' => 'formMaterial']])->dropDownList(
                                    ArrayHelper::map(CodesParam::find()->where(['type'=>'Unit Of Measurement'])->andWhere(['status'=>'active'])->all(), 'id', 'title'),
                                     ['prompt'=>'-Select-','class'=>'form-control floating uom_class']
                                    )->label(false) ?>

                                <?= $form->field($modelSmDetail, "[{$index}]uom", ['options' => ['class' => '','data-plugin' => 'formMaterial']])->hiddenInput(['maxlength' => true, 'readonly' => true, 'class' => 'uom_id_class form-control'])->label(false) ?>
                            </div>

                            <div class="custom-col-08">
                                <?= $form->field($modelSmDetail, "[{$index}]discount_per_product", ['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true, 'readonly' => true, 'class' => 'discount_per_product_class form-control'])->label(false) ?>
                            </div>

                            <div class="custom-col-08">
                                <?= $form->field($modelSmDetail, "[{$index}]total_discount", ['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true, 'readonly' => true, 'class' => 'total_discount_class form-control'])->label(false) ?>
                            </div>
                            
                            <div class="custom-col-08">
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

            <div style="margin-left: 15px;width: 100%;display: inline-block;   margin-bottom: 10px;">
                <button type="button" class="pull-left add-item btn btn-success btn-xs"><i class="icon md-plus" aria-hidden="true"></i> Add more </button>
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


        $(document).delegate('#smhead-branch_id','change',function(){

           var branch_id = $('#smhead-branch_id').val();

           $('.available_quantity_class').val('');
           $('.rate_class').val('');
           $('.batch_number_class').val('');
           $('.sell_rate_class').val('');
           $('.uom_class').val('');
           $('.uom_id_class').val('');
           
           $.ajax({
               type : 'POST',
               dataType : 'json',
               url : '".Url::toRoute('stock-view/find-product')."',
               data: {branch_id:branch_id},
               beforeSend : function( request ){
                   
               },
               success : function( data )
                   {   

                       newoptions = '<option value=1>NewO1</option><option value=2>NewO1</option>';

                       $('select.custom-select2').html(data.content);
                   }
           });

           

       });


        $(document).delegate('.sales_person_class','change',function(){
            var sales_person_id = $(this).val();
            
            $.ajax({
                type : 'POST',
                dataType : 'json',
                url : '".Url::toRoute('sales-person/find-commission')."',
                data: {sales_person_id:sales_person_id},
                beforeSend : function( request ){
                    
                },
                success : function( data )
                    {   
                        if(data.result == 'success'){ 

                            $('#sales_person_data').html(data.commission);
                            $('#smhead-commission').val(data.commission_value);
                                                                                  
                        }else{
                            $('#sales_person_data').html('');
                            $('#smhead-commission').val('');
                        }
                    }
            });

            return false;
        });

        $(document).delegate('.quantity_class','change',function(){

            var quantity = $(this).val();
            var item = $(this);
            var available_quantity = $(item).closest('.item').find('.available_quantity_class').val();



            if(parseInt(quantity) < 1 || parseInt(quantity) > parseInt(available_quantity) ){

                alert('Please put valid quantity');
                $(item).closest('.item').find('.total_class').val('');
                $(item).closest('.item').find('.quantity_class').val('');

            }else{

                // calculate total discount

                var discount_per_product = $(item).closest('.item').find('.discount_per_product_class').val();

                var actual_sell_rate = $(item).closest('.item').find('.actual_sell_rate_class').val();

                var sell_rate = $(item).closest('.item').find('.rate_class').val();

                if(sell_rate > actual_sell_rate)
                {
                    var total_discount = 0;
                }else{
                    var total_discount = discount_per_product * quantity;    
                }
                

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



        $(document).delegate('.discount_per_product_class','change',function(){

            var discount_per_product = $(this).val();
            var item = $(this);

            var quantity = $(item).closest('.item').find('.quantity_class').val();

            if(parseInt(quantity) < 1 ){

                alert('Please put valid quantity');

            }else{

                var total_discount = discount_per_product * quantity;

                $(item).closest('.item').find('.total_discount_class').val(total_discount);

            }

            var discount_amount = 0;
            $('.total_discount_class').each(function(){
                var input = $(this).val(); 
                discount_amount += parseInt( input);
            });

            $('#smhead-discount_amount').val(discount_amount);

            var sell_rate = $(item).closest('.item').find('.rate_class').val();

            var total_amount = parseFloat(Math.round( (quantity*sell_rate)*100 ) /100 ).toFixed(3) - total_discount;

            $(item).closest('.item').find('.total_class').val(total_amount);
            

        });

        $(document).delegate('.rate_class','change',function(){

            var sell_rate = $(this).val();
            var item = $(this);

            if(sell_rate < 1){

                alert('Please put valid rate');
                $(item).closest('.item').find('.total_class').val('');

            }else if(isNaN(sell_rate) == true){

                $(item).closest('.item').find('.rate_class').val('');

            }else{

                var quantity = $(item).closest('.item').find('.quantity_class').val();

                var actual_sell_rate = $(item).closest('.item').find('.actual_sell_rate_class').val();

                if(sell_rate > actual_sell_rate)
                {
                    var discount_per_product = 0.000;
                }else{
                    var discount_per_product = (actual_sell_rate - sell_rate);
                }

                

                $(item).closest('.item').find('.discount_per_product_class').val(parseFloat(Math.round( (discount_per_product)*100 ) /100 ).toFixed(3));

                var total_discount = discount_per_product * quantity;

                $(item).closest('.item').find('.total_discount_class').val(parseFloat(Math.round( (total_discount)*100 ) /100 ).toFixed(3));

                var total_amount = (actual_sell_rate * quantity) - total_discount;

                $(item).closest('.item').find('.total_class').val(parseFloat(Math.round( (total_amount)*100 ) /100 ).toFixed(3));

                var discount_amount = 0;
                $('.total_discount_class').each(function(){
                    var input = $(this).val(); 
                    discount_amount += parseInt( input);
                });

                $('#smhead-discount_amount').val(parseFloat(Math.round( (discount_amount)*100 ) /100 ).toFixed(3));

            }

            

        });


        $(document).delegate('.custom-select2','change',function(){
            
            var product_id = $(this).val();
            var item = $(this);

            var branch_id = $('#smhead-branch_id').val();

            $.ajax({
                type : 'POST',
                dataType : 'json',
                url : '".Url::toRoute('stock-transfer/find-product')."',
                data: {product_id:product_id,branch_id:branch_id},
                beforeSend : function( request ){
                    
                },
                success : function( data )
                    {   

                        if(data.result == 'success'){ 

                            $(item).closest('.item').find('.available_quantity_class').val(data.available_quantity);

                            $(item).closest('.item').find('.quantity_class').val(1);

                            $(item).closest('.item').find('.discount_per_product_class').val(parseFloat(Math.round( (0)*100 ) /100 ).toFixed(3));

                            $(item).closest('.item').find('.total_discount_class').val(parseFloat(Math.round( (0)*100 ) /100 ).toFixed(3));

                            $(item).closest('.item').find('.total_class').val(parseFloat(Math.round( (data.sell_rate*1)*100 ) /100 ).toFixed(3));

                            $(item).closest('.item').find('.rate_class').val(data.sell_rate);

                            $(item).closest('.item').find('.actual_sell_rate_class').val(data.sell_rate);

                            $(item).closest('.item').find('.actual-sell-rate-show').html('('+data.sell_rate+')');

                            $(item).closest('.item').find('.batch_number_class').val(data.batch_number);

                            $(item).closest('.item').find('.sell_rate_class').val(data.sell_rate);

                            $(item).closest('.item').find('.details_class').attr('href',data.view_popup);

                            $(item).closest('.item').find('.uom_class').val(data.uom);

                            $(item).closest('.item').find('.uom_id_class').val(data.uom_id);
                                                                                  
                        }
                    }
            });
            
            

        });

        $(document).delegate('.add-item','click',function(){

            /*$('.custom-select2').each(function(i,item){
              
              $(item).select2('destroy');
            });*/

            setTimeout(function(){
                $('.custom-select2').select2();
            },100)

            var branch_id = $('#smhead-branch_id').val();

           $('.available_quantity_class').val('');
           $('.rate_class').val('');
           $('.batch_number_class').val('');
           $('.sell_rate_class').val('');
           $('.uom_class').val('');
           $('.uom_id_class').val('');
           
           $.ajax({
               type : 'POST',
               dataType : 'json',
               url : '".Url::toRoute('stock-view/find-product')."',
               data: {branch_id:branch_id},
               beforeSend : function( request ){
                   
               },
               success : function( data )
                   {   

                       newoptions = '<option value=1>NewO1</option><option value=2>NewO1</option>';

                       $('select.custom-select2').html(data.content);
                   }
           });
            
        });

        $('.custom-select2').select2();

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

       /* window.initSelect2Loading = function(id, optVar){
            initS2Loading(id, optVar)
        };
        window.initSelect2DropStyle = function(id, kvClose, ev){
            initS2Loading(id, kvClose, ev)
        };

        $('.dynamicform_wrapper').on('afterInsert', function(e, item) {
            
        });*/


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

<?php
    
    $this->registerJs("

      // changed id to class
      $('.modalButton').click(function (){

        if($(this).attr('href') == '#'){
            $('#modal').modal('show').find('#modalContent').html('Please Select Product');
        }else{

            $.get($(this).attr('href'), function(data) {
              $('#modal').modal('show').find('#modalContent').html(data);
            });

        }
        
        return false;
      });

    ", yii\web\View::POS_READY, "modal_open");   
?>

<style type="text/css">
    .actual-sell-rate-show{
        margin-top: -20px;
        color: #aaa;
        font-size: 12px;
        margin-left: 10px;
    }
</style>