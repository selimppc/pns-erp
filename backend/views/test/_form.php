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
                    
                ],
            ]); 
        ?>

    <div class="panel panel-default">
        
        <div class="panel-body container-items"><!-- widgetContainer -->
            <div style="width: 100%;display: inline-block;">
                <div class="custom-column-37">
                    <label class="control-label only-label" for="">Product</label>
                </div>
                <div class="custom-column-9">
                    <label class="control-label only-label" for="">Quantity</label>
                </div>
                
            </div>
            <?php foreach ($modelsPurchaseDetail as $index => $modelPurchaseDetail): ?>
                <div class="item"><!-- widgetBody -->

                    <button type="button" class="pull-right remove-item btn-danger btn-xs"><i class="icon md-close" aria-hidden="true"></i> Remove</button>
                    <?php
                        // necessary for update action.
                        if (!$modelPurchaseDetail->isNewRecord) {
                            echo Html::activeHiddenInput($modelPurchaseDetail, "[{$index}]id");
                        }
                    ?>
                    <div class="row">

                        <div class="custom-column-40">
                            <div class="form-group form-material floating" data-plugin="formMaterial">

                                <?php

                                    echo $form->field($modelPurchaseDetail, "[{$index}]product_id")->dropDownList(
                                        Product::get_product_list(),[
                                            'class' => 'custom-select2',
                                            'prompt'=>'Select...'
                                        ]
                                        )->label(false);

                                ?>

                                

                            </div>
                        </div>

                        <div class="custom-column-10">
                            <?= $form->field($modelPurchaseDetail,"[{$index}]quantity", ['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true,'class' => 'quantity_class'])->label(false) ?>
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



<?php
    
    $this->registerJs("

        $(document).delegate('.custom-select2','change',function(){
            
            var product_id = $(this).val();
            
            $(this).closest('.item').find('.quantity_class').val(product_id);

        });

        $(document).delegate('.add-item','click',function(){

            /*$('.custom-select2').each(function(i,item){
              
              $(item).select2('destroy');
            });*/

            setTimeout(function(){
                $('.custom-select2').select2();
            },1000)
            
        });

        $('.custom-select2').select2();
       
        /*window.initSelect2Loading = function(id, optVar){
            initS2Loading(id, optVar)
        };
        window.initSelect2DropStyle = function(id, kvClose, ev){
            initS2Loading(id, kvClose, ev)
        };*/

     ", yii\web\View::POS_READY, "exchange_rate_change_based_on_currency");   
?>