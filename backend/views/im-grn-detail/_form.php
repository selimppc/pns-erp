<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;
use backend\models\ImGrnHead;
use backend\models\Product;
use backend\models\CodesParam;

use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\ImGrnDetail */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="form-two-column">
    <?php $form = ActiveForm::begin(); ?>

    <div class="row">


        <div class="col-md-12">

            <?= $form->field($model, 'grn_number',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true,'readonly' => $model->grn_number]) ?>

            <div class="form-group form-material floating" data-plugin="formMaterial">
                <?php

                echo $form->field($model, 'product_id')->widget(Select2::classname(), [
                    'data' => Product::get_product_list(),
                    'language' => '',
                    'options' => ['placeholder' => 'Select a product ...'],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'classs' => 'form-group form-material floating',
                        'data-plugin' => 'formMaterial'
                    ],
                ]);
                ?>


            </div>

            <?= $form->field($model, 'batch_number',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'expire_date',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput() ?>


            <div class="form-group form-material floating" data-plugin="formMaterial">

            <?= $form->field($model, 'uom')
                        ->dropDownList(
                            ArrayHelper::map(CodesParam::find()->where(['type'=>'Unit Of Measurement'])->all(), 'id', 'title'),
                             ['prompt'=>'-Select-','class'=>'form-control floating']
                        ); ?>

            </div>            

            <?= $form->field($model, 'quantity',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true,'readonly' => true]) ?>

            <?= $form->field($model, 'receive_quantity',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>            

            <?= $form->field($model, 'cost_price',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>
            
            <?= $form->field($model, 'row_amount',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true,'readonly' => true]) ?>

            <input type="hidden" name="actual_quantity" id="actual_quantity" value="<?=$model->receive_quantity?>">
            <input type="hidden" name="actual_cost_price" id="actual_cost_price" value="<?=$model->cost_price?>">

        </div>

    </div>    


    <div class="form-group" style="margin-top: 20px;">
        <?= Html::submitButton($model->isNewRecord ? 'Save Changes' : 'Save Changes', ['class' => $model->isNewRecord ? 'btn-primary waves-effect pull-right' : 'btn-primary waves-effect pull-right']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

<?php
    
    $this->registerJs("       

        $('#imgrndetail-receive_quantity').change(function (e) {
            
            var receive_quantity = $('#imgrndetail-receive_quantity').val();
            var cost_price = $('#imgrndetail-cost_price').val();
            var actual_quantity = $('#actual_quantity').val();

            if(receive_quantity > actual_quantity){

                var message = 'Receive Quantity must be less than or equal '+actual_quantity;
                alert(message);
                $('#imgrndetail-receive_quantity').val(actual_quantity);

                var receive_quantity = actual_quantity;

            }

            var row_amount = parseFloat(Math.round( (receive_quantity*cost_price)*100 ) /100 ).toFixed(3);

            $('#imgrndetail-row_amount').val(row_amount);

        });

        $('#imgrndetail-cost_price').change(function (e) {
            
            var receive_quantity = $('#imgrndetail-receive_quantity').val();
            var cost_price = $('#imgrndetail-cost_price').val();
            var actual_cost_price = $('#actual_cost_price').val();

            if(isNaN(cost_price) == true){
                $('#imgrndetail-cost_price').val(actual_cost_price);
                var cost_price = actual_cost_price;
            }
            
            var row_amount = parseFloat(Math.round( (receive_quantity*cost_price)*100 ) /100 ).toFixed(3);

            $('#imgrndetail-row_amount').val(row_amount);

        });


     ", yii\web\View::POS_READY, "total_amount_change_with_receive_quantity_cost_price");   
?>