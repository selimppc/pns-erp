<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;
use backend\models\Currency;
use backend\models\Supplier;
use backend\models\CodesParam;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>



<div class="product-form form-two-column">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <div class="row">

        <div class="col-md-6">

            <?= $form->field($model, 'product_code',
                ['options' => [
                    'class' => 'form-group form-material floating',
                    'data-plugin' => 'formMaterial'
                ]])->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'title',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'description',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

            

            <div class="form-group form-material floating" data-plugin="formMaterial">

            <?= $form->field($model, 'class')
                        ->dropDownList(
                            ArrayHelper::map(CodesParam::find()->where(['type'=>'Product Class'])->andWhere(['status'=>'active'])->all(), 'id', 'title'),
                             ['class'=>'form-control floating']
                        ); ?>

            </div>

            <div class="form-group form-material floating" data-plugin="formMaterial">

            <?= $form->field($model, 'group')
                        ->dropDownList(
                            ArrayHelper::map(CodesParam::find()->where(['type'=>'Product Group'])->andWhere(['status'=>'active'])->all(), 'id', 'title'),
                             ['prompt'=>'-Select-','class'=>'form-control floating']
                        ); ?>

            </div>

            <div class="form-group form-material floating" data-plugin="formMaterial">

            <?= $form->field($model, 'category')
                        ->dropDownList(
                            ArrayHelper::map(CodesParam::find()->where(['type'=>'Product Category'])->andWhere(['status' => 'active'])->all(), 'id', 'title'),
                             ['prompt'=>'-Select-','class'=>'form-control floating']
                        ); ?>

            </div>

            <?= $form->field($model, 'model',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'size',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'origin',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'manufacturer_code',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'manufacturer_year',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'speed',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'machine_size',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'generic',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

            <div class="form-group form-material floating" data-plugin="formMaterial">

                <?= $form->field($model, 'stock_type')
                            ->dropDownList(
                                array ('stock'=>'Stock', 'non'=>'Non Stock'),
                                array ('class'=>'form-control') 
                            ); ?>

            </div>


            <div class="form-group form-material floating" data-plugin="formMaterial">

                <?= $form->field($model, 'supplier_id')
                            ->dropDownList(
                                ArrayHelper::map(Supplier::find()->all(), 'id', 'org_name'),
                                 ['prompt'=>'-Select-','class'=>'form-control']
                            ); ?>

            </div>

            <?= $form->field($model, 'image')->fileInput() ?>

            <?php
                if(!empty($model->image)){
                    $image_url = Url::base('').'/uploads/thumb/'.$model->image;
            ?>
                <div style="width: 60%;float: right;margin-top:10px;">
                    <img style="width: 100px;" src="<?=$image_url?>">
                </div>    

            <?php         
                }
            ?>

            
        </div>

        <div class="col-md-6">

            
            <?= $form->field($model, 'sell_rate',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

            <div class="form-group form-material floating" data-plugin="formMaterial">

            <?= $form->field($model, 'sell_uom')
                        ->dropDownList(
                            ArrayHelper::map(CodesParam::find()->where(['type'=>'Unit Of Measurement'])->andWhere(['status'=>'active'])->all(), 'id', 'title'),
                             ['prompt'=>'-Select-','class'=>'form-control floating']
                        ); ?>

            </div>

            <?= $form->field($model, 'cost_price',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

            <div class="form-group form-material floating" data-plugin="formMaterial">

            <?= $form->field($model, 'purchase_uom')
                        ->dropDownList(
                            ArrayHelper::map(CodesParam::find()->where(['type'=>'Unit Of Measurement'])->andWhere(['status' => 'active'])->all(), 'id', 'title'),
                             ['prompt'=>'-Select-','class'=>'form-control floating']
                        ); ?>

            </div>

            <?= $form->field($model, 'purchase_uom_qty',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

            <div class="form-group form-material floating" data-plugin="formMaterial">

            <?= $form->field($model, 'stock_uom')
                        ->dropDownList(
                            ArrayHelper::map(CodesParam::find()->where(['type'=>'Unit Of Measurement'])->andWhere(['status' => 'active'])->all(), 'id', 'title'),
                             ['prompt'=>'-Select-','class'=>'form-control floating']
                        ); ?>

            </div>

            <?= $form->field($model, 'stock_uom_qty',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'pack_size',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

            <div class="form-group form-material floating" data-plugin="formMaterial">

            <?= $form->field($model, 'currency_id')
                        ->dropDownList(
                            ArrayHelper::map(Currency::find()->where(['status' => 'active'])->all(), 'id', 'title'),
                             ['prompt'=>'-Select-','class'=>'form-control floating']
                        ); ?>

            </div>

            <?= $form->field($model, 'exchange_rate',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>
            
            <?= $form->field($model, 'max_level',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'min_level',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>            

            <?= $form->field($model, 're_order',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'style',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

             <?= $form->field($model, 'sort_order',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['maxlength' => true]) ?>

            <div class="form-group form-material floating" data-plugin="formMaterial">

                <?= $form->field($model, 'status')
                            ->dropDownList(
                                array ('active'=>'Active', 'inactive'=>'Inactive','cancel' => 'Cancel'),
                                array ('class'=>'form-control') 
                            ); ?>

            </div>

        </div>

    </div>
    



    
    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Save Changes') : Yii::t('app', 'Save Changes'), ['class' => $model->isNewRecord ? 'btn btn-primary waves-effect form-two-column pull-right' : 'btn btn-primary waves-effect form-two-column pull-right']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<?php
    
    $this->registerJs("

        $('#product-currency_id').change(function (e) {
            var currency = $('#product-currency_id').val();

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
                            $('#product-exchange_rate').val(data.exchange_rate);
                        }
                    }
            });

        });

     ", yii\web\View::POS_READY, "exchange_rate_change_based_on_currency");   
?>