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
use backend\models\VwImStockView;
use kartik\date\DatePicker;

use yii\bootstrap\Modal;


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

        <div style="width: 100%;display: inline-block;">
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

        </div>


        <div class="col-md-6">
            <h2 style="background: #FFCCFF;padding: 7px;width: 100%;font-weight: 500;
    border-radius: 5px;font-size: 15px;">Store, from where the stock will transfer</h2>


            <div class="col-md-4">

                <div class="form-group form-material floating" data-plugin="formMaterial">

                    <?= $form->field($modelTransferHead, 'from_branch_id')
                                ->dropDownList(
                                    ArrayHelper::map(Branch::find()->where(['status'=>'active'])->all(), 'id', 'title'),
                                     ['prompt'=>'-Select-','class'=>'form-control']
                                ); ?>

                </div>

            </div>

            <div class="col-md-4">

                <div class="form-group form-material floating" data-plugin="formMaterial">

                    <?= $form->field($modelTransferHead, 'from_currency_id')
                                ->dropDownList(
                                    ArrayHelper::map(Currency::find()->where(['status'=>'active'])->all(), 'id', 'currency_code'),
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
                                    ArrayHelper::map(Branch::find()->where(['status'=>'active'])->all(), 'id', 'title'),
                                     ['prompt'=>'-Select-','class'=>'form-control']
                                ); ?>

                </div>

            </div>

            <div class="col-md-4">

                <div class="form-group form-material floating" data-plugin="formMaterial">

                    <?= $form->field($modelTransferHead, 'to_currency_id')
                                ->dropDownList(
                                    ArrayHelper::map(Currency::find()->where(['status'=>'active'])->all(), 'id', 'currency_code'),
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
            'available_quantity',
            'uom',
            'quantity',
            #'rate'
        ],
    ]); 
    ?>

        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-envelope"></i> Stock Transfer Details
                
                <div class="clearfix"></div>
            </div>

            <div class="panel-body container-items"><!-- widgetContainer -->

                <div class="row">
                    <div class="custom-col-35">
                        <label class="control-label only-label" for="">Product</label>
                    </div> 
                    <div class="custom-col-05"></div>    
                    <div class="custom-col-07">
                        <label class="control-label only-label" for="">Aval Qty</label>
                    </div>        
                    <div class="custom-col-15">
                        <label class="control-label only-label" for="">Rate</label>
                    </div>              
                    <div class="custom-col-07">
                        <label class="control-label only-label" for="">Quantity</label>
                    </div>                                                     
                    <div class="custom-col-07">
                        <label class="control-label only-label" for="">UOM</label>
                    </div>                                       
                    <div class="custom-col-15">
                        <label class="control-label only-label" for="">Total</label>
                    </div>                    
                    <div class="col-md-1">
                        
                    </div>
                    
                </div>

                <?php foreach ($modelsTransferDetail as $index => $modelTransferDetail): ?>

                    <div class="item"><!-- widgetBody -->
                        
                        <?php
                            // necessary for update action.
                            if (!$modelTransferDetail->isNewRecord) {
                                echo Html::activeHiddenInput($modelTransferDetail, "[{$index}]id");

                                $modelTransferDetail->uom_name = $modelTransferDetail->uom;
                            }
                        ?>

                        <div class="row">

                            <div class="custom-col-35">
                                <div class="form-group form-material floating" data-plugin="formMaterial">

                                    <?php
                                        echo $form->field($modelTransferDetail, "[{$index}]product_id")->dropDownList(
                                            VwImStockView::get_product_list_dpends_branch(isset($modelTransferHead->from_branch_id) && !empty($modelTransferHead->from_branch_id)?$modelTransferHead->from_branch_id:''),[
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

                            <div class="custom-col-07">
                                <?= $form->field($modelTransferDetail, "[{$index}]available_quantity", ['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true,'readonly' => true, 'class' => 'available_quantity_class form-control'])->label(false) ?>
                            </div>

                            <div class="custom-col-15">
                                <?= $form->field($modelTransferDetail, "[{$index}]rate", ['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true,'class' => 'rate_class form-control'])->label(false) ?>
                            </div>

                            <div class="custom-col-07">
                                <?= $form->field($modelTransferDetail, "[{$index}]quantity", ['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true, 'class' => 'quantity_class form-control'])->label(false) ?>
                            </div>

                            <div class="custom-col-07">


                                <?= $form->field($modelTransferDetail, "[{$index}]uom_name", ['options' => ['class' => 'uom_class form-group form-material floating','data-plugin' => 'formMaterial']])->dropDownList(
                                ArrayHelper::map(CodesParam::find()->where(['type'=>'Unit Of Measurement'])->andWhere(['status'=>'active'])->all(), 'id', 'title'),
                                 ['prompt'=>'-Select-','class'=>'form-control floating uom_class']
                                )->label(false) ?>

                                <?= $form->field($modelTransferDetail, "[{$index}]uom", ['options' => ['class' => '','data-plugin' => 'formMaterial']])->hiddenInput(['maxlength' => true, 'readonly' => true, 'class' => 'uom_id_class form-control'])->label(false) ?>
                            </div>
                           
                           <div class="custom-col-15">
                                <?= $form->field($modelTransferDetail, "[{$index}]total", ['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true, 'readonly' => true, 'class' => 'total_class form-control'])->label(false) ?>

                            </div>

                            <div class="col-md-1">
                                <div class="row">
                                    <button type="button" class="pull-right remove-item btn-danger btn-xs"><i class="icon md-close" aria-hidden="true"></i> Remove</button>
                                </div>
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


<?php 
        Modal::begin([
            'header' => 'Product Details',
            'id' => 'modal',
            'size' => 'modal-lg',
        ]);
        echo "<div id='modalContent'></div>";
        Modal::end();
?>


<?php
    
    $this->registerJs("

        $(document).delegate('#imtransferhead-from_branch_id','change',function(){

           var branch_id = $('#imtransferhead-from_branch_id').val();

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

        $(document).delegate('.quantity_class','change',function(){

            var quantity = $(this).val();
            var item = $(this);
            var available_quantity = $(item).closest('.item').find('.available_quantity_class').val();



            if(parseInt(quantity) < 1 || parseInt(quantity) > parseInt(available_quantity) ){

                alert('Please put valid quantity');
                $(item).closest('.item').find('.total_class').val('');
                $(item).closest('.item').find('.quantity_class').val('');

            }else{

                var sell_rate = $(item).closest('.item').find('.rate_class').val();

                var total_amount = parseFloat(Math.round( (quantity*sell_rate)*100 ) /100 ).toFixed(3);

                $(item).closest('.item').find('.total_class').val(total_amount);
            }

            

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

                var total_amount = parseFloat(Math.round( (quantity*sell_rate)*100 ) /100 ).toFixed(3);

                $(item).closest('.item').find('.total_class').val(total_amount);

            }

            

        });

        $(document).delegate('.custom-select2','change',function(){
            
            var product_id = $(this).val();
            var item = $(this);

            var branch_id = $('#imtransferhead-from_branch_id').val();

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

                            $(item).closest('.item').find('.rate_class').val(data.sell_rate);

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
            
        });

        $('.custom-select2').select2();


        $('#imtransferhead-from_currency_id').change(function (e) {
            var currency = $('#imtransferhead-from_currency_id').val();

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
                            $('#imtransferhead-from_exchange_rate').val(data.exchange_rate);
                        }
                    }
            });

        });


        $('#imtransferhead-to_currency_id').change(function (e) {
            var currency = $('#imtransferhead-to_currency_id').val();

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
                            $('#imtransferhead-to_exchange_rate').val(data.exchange_rate);
                        }
                    }
            });

        });


       /* window.initSelect2Loading = function(id, optVar){
            initS2Loading(id, optVar)
        };
        window.initSelect2DropStyle = function(id, kvClose, ev){
            initS2Loading(id, kvClose, ev)
        };*/

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