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

    <?php 
        if(Yii::$app->session->hasFlash('error')){
    ?>
        <div class="alert alert-danger">
          <?= Yii::$app->session->getFlash('error'); ?>
        </div>
    <?php 
        }
    ?>

	<div class="row">

		<div class="col-md-2">
            <?= $form->field($model, 'sm_number',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true,'readonly' => 1]) ?>
        </div>

        <div class="col-md-2">
            <div class="form-group form-material floating" data-plugin="formMaterial">
                <?php

                echo $form->field($model, 'date')->widget(DatePicker::classname(), [
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

                <?= $form->field($model, 'customer_id')
                            ->dropDownList(
                                ArrayHelper::map(Customer::find()->where(['status'=>'active'])->all(), 'id', 'name'),
                                 ['prompt'=>'-Select-','class'=>'form-control']
                            ); ?>

            </div>

        </div>

        <div class="col-md-2">

            <div class="form-group form-material" data-plugin="formMaterial">

                <?= $form->field($model, 'pay_terms')
                            ->dropDownList(
                                array ('Cash'=>'Cash', 'Credit'=>'Credit'),
                               ['class'=>'form-control']
                            ); ?>

                <?= $form->field($model, 'doc_type')->hiddenInput(['value'=>'sales'])->label(false); ?>            

            </div>

        </div>


        <div class="col-md-2">

            <div class="form-group form-material floating" data-plugin="formMaterial">

                <?= $form->field($model, 'currency_id')
                            ->dropDownList(
                                ArrayHelper::map(Currency::find()->where(['status'=>'active'])->all(), 'id', 'currency_code'),
                                 ['prompt'=>'-Select-','class'=>'form-control']
                            ); ?>

            </div>

        </div>

        <div class="col-md-2">

            <?= $form->field($model, 'exchange_rate',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

        </div>

        <div class="col-md-2">

            <div class="form-group form-material floating" data-plugin="formMaterial">

                <?= $form->field($model, 'branch_id')
                            ->dropDownList(
                                ArrayHelper::map(Branch::find()->where(['status'=>'active'])->all(), 'id', 'branch_code'),
                                 ['prompt'=>'-Select-','class'=>'form-control']
                            ); ?>

            </div>

        </div>

        <div class="col-md-10">

            <?= $form->field($model, 'note',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textArea() ?>

        </div>


        <p style="color: darkorange;margin-left: 15px;font-weight: 700;width:100%;display: inline-block;">
        	Write down your total amount and vat amount below
        </p>

        <div class="col-md-2">

            <?= $form->field($model, 'prime_amount',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

        </div>

        <div class="col-md-2">

            <?= $form->field($model, 'tax_amount',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

        </div>

        <div class="col-md-2">

            <?= $form->field($model, 'net_amount',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true,'readonly' => 1]) ?>

        </div>

        <div class="col-md-12">
        	<?= Html::submitButton($model->isNewRecord ? 'Save Changes' : 'Save Changes', ['class' => 'btn btn-primary']) ?>
        </div>
	</div>

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


     ", yii\web\View::POS_READY, "exchange_rate_change_based_on_currency");   
?>

<?php
    
    $this->registerJs("

        $('#smhead-prime_amount').change(function (e) {
            
            var prime_amount = parseInt($('#smhead-prime_amount').val());
            var tax_amount = parseInt($('#smhead-tax_amount').val());

            if(isNaN(prime_amount) == true){
                $('#smhead-prime_amount').val('0'); 
                var prime_amount = 0;               
            }

            var net_amount = prime_amount+tax_amount;

            $('#smhead-net_amount').val(net_amount);

        });

        $('#smhead-tax_amount').change(function (e) {
            
            var tax_amount = parseInt($('#smhead-tax_amount').val());
            var prime_amount = parseInt($('#smhead-prime_amount').val());

            if(isNaN(tax_amount) == true){
                $('#smhead-tax_amount').val('0');
                var tax_amount = 0;                
            }

            if(isNaN(prime_amount) == true){
                var prime_amount = 0;
            }
            
            var net_amount = prime_amount+tax_amount;

            $('#smhead-net_amount').val(net_amount);

        });


     ", yii\web\View::POS_READY, "total_amount_change_with_receive_quantity_cost_price");   
?>