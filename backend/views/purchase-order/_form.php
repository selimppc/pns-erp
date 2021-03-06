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

/*use kartik\select2\Select2;*/


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
                                    ArrayHelper::map(Supplier::find()->where(['status'=>'active'])->all(), 'id', 'org_name'),
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
                                    ArrayHelper::map(Branch::find()->where(['status'=>'active'])->all(), 'id', 'title'),
                                     ['prompt'=>'-Select-','class'=>'form-control']
                                ); ?>

                </div>

            </div>

            <div class="col-md-2">

                <div class="form-group form-material floating" data-plugin="formMaterial">

                    <?= $form->field($modelPurchaseHead, 'currency_id')
                                ->dropDownList(
                                    ArrayHelper::map(Currency::find()->where(['status'=>'active'])->all(), 'id', 'currency_code'),
                                     ['prompt'=>'-Select-','class'=>'form-control']
                                ); ?>

                </div>

            </div>

            <div class="col-md-2">

                <?= $form->field($modelPurchaseHead, 'exchange_rate',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

            </div>

            <div class="col-md-2">

                <?= $form->field($modelPurchaseHead, 'discount_rate',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

            </div>

            
            <div class="col-md-2">
             <?= $form->field($modelPurchaseHead, 'status',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true,'readonly' => 1]) ?>
            </div> 

            <div class="col-md-2">

                <?= $form->field($modelPurchaseHead, 'note',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

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
            
            <div class="clearfix"></div>
        </div>
        <div class="panel-body container-items"><!-- widgetContainer -->
            <div class="row">
                <div class="custom-col-5">
                    <label class="control-label only-label" for="">Product</label>
                </div>
                <div class="custom-col-07">
                    <label class="control-label only-label" for="">Qty</label>
                </div>
                <div class="custom-col-07">
                    <label class="control-label only-label" for="">UOM</label>
                </div>
                <div class="custom-col-07">
                    <label class="control-label only-label" for="">UOM Qty</label>
                </div>
                <div class="custom-col-2">
                    <label class="control-label only-label" for="">Purchase Rate</label>
                </div>
                <div class="custom-col-06">

                </div>
            </div>
            <?php foreach ($modelsPurchaseDetail as $index => $modelPurchaseDetail): ?>
                <div class="item"><!-- widgetBody -->
                    
                    <?php
                        // necessary for update action.
                        if (!$modelPurchaseDetail->isNewRecord) {
                            echo Html::activeHiddenInput($modelPurchaseDetail, "[{$index}]id");
                        }
                    ?>
                    <div class="row">

                        <div class="custom-col-5">
                            <div class="form-group form-material floating" data-plugin="formMaterial">

                                <?php

                                    echo $form->field($modelPurchaseDetail, "[{$index}]product_id")->dropDownList(
                                        Product::get_product_list(),[
                                            'class' => 'custom-select2 form-control',
                                            'prompt'=>'--Select Product--'
                                        ]
                                        )->label(false);

                                ?>

                                

                            </div>
                        </div>

                        <div class="custom-col-07">
                            <?= $form->field($modelPurchaseDetail,"[{$index}]quantity", ['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true])->label(false) ?>
                        </div>

                        <div class="custom-col-07">
                            

                            <?= $form->field($modelPurchaseDetail, "[{$index}]uom", ['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->dropDownList(
                                    ArrayHelper::map(CodesParam::find()->where(['type'=>'Unit Of Measurement'])->andWhere(['status'=>'active'])->all(), 'id', 'title'),
                                     ['prompt'=>'-Select-','class'=>'form-control floating uom_class']
                                )->label(false) ?>
                        </div>

                        <div class="custom-col-07">
                            <?= $form->field($modelPurchaseDetail, "[{$index}]uom_quantity", ['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true,'class' => 'uom_quantity_class form-control'])->label(false) ?>
                        </div>

                        <div class="custom-col-2">
                            <?= $form->field($modelPurchaseDetail, "[{$index}]purchase_rate", ['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true,'class' =>'purchase_rate_class form-control'])->label(false) ?>
                        </div>

                        <div class="custom-col-06">                            
                            <button type="button" class="pull-right remove-item btn-danger btn-xs">Remove</button>
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


        <?= Html::submitButton($modelPurchaseDetail->isNewRecord ? 'Save Changes' : 'Save Changes', ['class' => 'btn btn-primary']) ?>



    <?php ActiveForm::end(); ?>

<style type="text/css">
    .form-group .select2{
        width: 100% !important;
    }
</style>
<?php
    
    $this->registerJs("

        $(document).delegate('.custom-select2','change',function(){
            
            var product_id = $(this).val();
            var item = $(this);

            $.ajax({
                type : 'POST',
                dataType : 'json',
                url : '".Url::toRoute('product/find-product')."',
                data: {product_id:product_id},
                beforeSend : function( request ){
                    
                },
                success : function( data )
                    {   

                        if(data.result == 'success'){ 
                            $(item).closest('.item').find('.uom_quantity_class').val(data.sell_uom_qty);
                            $(item).closest('.item').find('.uom_class').val(data.sell_uom);
                            $(item).closest('.item').find('.purchase_rate_class').val(data.sell_rate);
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


        $('#pppurchasehead-currency_id').change(function (e) {
            var currency = $('#pppurchasehead-currency_id').val();

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
                            $('#pppurchasehead-exchange_rate').val(data.exchange_rate);
                        }
                    }
            });

        });

        /*window.initSelect2Loading = function(id, optVar){
            initS2Loading(id, optVar)
        };
        window.initSelect2DropStyle = function(id, kvClose, ev){
            initS2Loading(id, kvClose, ev)
        };*/

     ", yii\web\View::POS_READY, "exchange_rate_change_based_on_currency");   
?>