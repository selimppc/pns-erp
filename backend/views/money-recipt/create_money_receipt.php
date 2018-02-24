<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

use backend\models\Currency;
use backend\models\AmCoa;

use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $searchModel backend\models\ImGrnHeadSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Create Money Receipt';
$this->params['breadcrumbs'][] = $this->title;
?>


<?php Pjax::begin(); ?> 

<div class="page-header">

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=Url::base('')?>">Home</a></li>
        <li class="breadcrumb-item">Sales</li>
        <li class="breadcrumb-item active"><?= Html::encode($this->title) ?></li>
      </ol>
     
      <div class="middle-menu-bar">
        
        <?php
          echo \yii\helpers\Html::a( '<i class="icon md-arrow-left" aria-hidden="true"></i> Back', Yii::$app->request->referrer,['class' => 'back']);
        ?>    
      </div>
</div>


<div class="page-content">
  <!-- Panel Basic -->
  <div class="panel">


        <?php 
            if(Yii::$app->session->hasFlash('success')){
        ?>
            <div class="alert alert-success">
              <?= Yii::$app->session->getFlash('success'); ?>
            </div>
        <?php 
            }
        ?>

        <?php 
            if(Yii::$app->session->hasFlash('error')){
        ?>
            <div class="alert alert-danger">
              <?= Yii::$app->session->getFlash('error'); ?>
            </div>
        <?php 
            }
        ?>

        <div id="flag_desc">
            <div id="flag_desc_text">
                <?php
                    if(isset(\Yii::$app->params['create_money_receipt']) && !empty(\Yii::$app->params['create_money_receipt'])){
                      echo \Yii::$app->params['create_money_receipt'];
                    }
                ?>
            </div>
        </div>


        <div class="panel-body">

        	<?php $form = ActiveForm::begin(); ?>

		        <div class="form-width-49 pull-left grid-view">
		        	<h1>Money Receipt</h1>

		        	<div class="product-form form-two-column">
		        		<div class="row">
		        			<div class="col-md-6">

		        				<?= $form->field($model, 'sm_number',
				                	['options' => [
				                    'class' => 'form-group form-material floating',
				                    'data-plugin' => 'formMaterial'
				                	],
				                	 "template" => "<label> Receipt Number </label>\n{input}\n{hint}\n{error}"
				                	])->textInput(['maxlength' => true,'readonly' => true]) ?>


				                <?= $form->field($model, 'money_receipt_customer_name',
				                	['options' => [
				                    'class' => 'form-group form-material floating',
				                    'data-plugin' => 'formMaterial'
				                	],
				                	 "template" => "<label> Customer Name </label>\n{input}\n{hint}\n{error}"
				                	])->textInput(['maxlength' => true,'readonly' => true]) ?>	

				                <?= $form->field($model, 'customer_id',
				                	['options' => [
				                    'class' => 'form-group form-material floating',
				                    'data-plugin' => 'formMaterial'
				                	],
				                	
				                	])->hiddenInput(['maxlength' => true,'readonly' => true]) ?>		

				                <?= $form->field($model, 'check_number',
				                	['options' => [
				                    'class' => 'form-group form-material floating',
				                    'data-plugin' => 'formMaterial'
				                	],
				                	 "template" => "<label> Check Number </label>\n{input}\n{hint}\n{error}"
				                	])->textInput(['maxlength' => true]) ?>	

				                <?= $form->field($model, 'currency_id',[
									'options' => [
				                    	'class' => 'form-group form-material floating',
				                    	'data-plugin' => 'formMaterial'
				                		],
				                	])
	                                ->dropDownList(
	                                    ArrayHelper::map(Currency::find()->where(['status'=>'active'])->all(), 'id', 'currency_code'),
	                                     ['prompt'=>'-Select-','class'=>'form-control']
	                                ); ?>		

				                <?= $form->field($model, 'status',
				                	['options' => [
				                    'class' => 'form-group form-material floating',
				                    'data-plugin' => 'formMaterial'
				                	],
				                	 "template" => "<label> Status </label>\n{input}\n{hint}\n{error}"
				                	])->textInput(['maxlength' => true, 'readonly' => true]) ?>	

				                <?= $form->field($model, 'note',
				                	['options' => [
				                    'class' => 'form-group form-material floating',
				                    'data-plugin' => 'formMaterial'
				                	],
				                	 "template" => "<label> Note </label>\n{input}\n{hint}\n{error}"
				                	])->textInput(['maxlength' => true]) ?>			


		        			</div>

		        			<div class="col-md-6">

		        				<?= $form->field($model, 'date',
				                	['options' => [
				                    'class' => 'form-group form-material floating',
				                    'data-plugin' => 'formMaterial'
				                	],
				                	 "template" => "<label> Receipt Date </label>\n{input}\n{hint}\n{error}"
				                	])->textInput(['maxlength' => true,'readonly' => true]) ?>


				                <?= $form->field($model, 'am_coa_id',[
									'options' => [
				                    	'class' => 'form-group form-material floating',
				                    	'data-plugin' => 'formMaterial'
				                		],
				                	])
	                                ->dropDownList(
	                                    ArrayHelper::map(AmCoa::find()->where(['status'=>'active'])->all(), 'id', 'title'),
	                                     ['prompt'=>'-Select-','class'=>'form-control']
	                                ); ?>
	                            
								<?= $form->field($model, 'money_receipt_amount',
				                	['options' => [
				                    'class' => 'form-group form-material floating',
				                    'data-plugin' => 'formMaterial'
				                	],
				                	 "template" => "<label> Amount </label>\n{input}\n{hint}\n{error}"
				                	])->textInput(['maxlength' => true]) ?>	

				                <input type="hidden" id="balance" value="0" style="width: 50px;">	

				                <?= $form->field($model, 'exchange_rate',
				                	['options' => [
				                    'class' => 'form-group form-material floating',
				                    'data-plugin' => 'formMaterial'
				                	],
				                	 "template" => "<label> Exchange Rate </label>\n{input}\n{hint}\n{error}"
				                	])->textInput(['maxlength' => true]) ?>		 	

				                <?= $form->field($model, 'money_receipt_branch',
				                	['options' => [
				                    'class' => 'form-group form-material floating',
				                    'data-plugin' => 'formMaterial'
				                	],
				                	 "template" => "<label> Branch </label>\n{input}\n{hint}\n{error}"
				                	])->textInput(['maxlength' => true,'readonly' => true]) ?>	

				                <?= $form->field($model, 'branch_id',
				                	['options' => [
				                    'class' => 'form-group form-material floating',
				                    'data-plugin' => 'formMaterial'
				                	],
				                	
				                	])->hiddenInput(['maxlength' => true,'readonly' => true]) ?>			 		


		        			</div>

		        		</div>
		        	</div>
		        </div>

		        <div class="form-width-49 pull-right grid-view">
		        	<h1>Unpaid Invoice List of - <?=$data->customer_name?></h1>

		        	<div class="table-responsive">
		                <table class="items">
		                    <thead>
		                      <tr>
		                      	<th>Invoice No</th>
		                      	<th>Receivable Amount</th>
		                      </tr>
		                    </thead>
		                    <tbody class="unpaid-items">

		                    	<?php
		                    		$total_amount = 0;
		                    		if(!empty($unpaid_money_received))
		                    		{
		                    			foreach($unpaid_money_received as $unpaid_money_receipt)
		                    			{
		                    				$total_amount+=$unpaid_money_receipt->amount;
		                    	?>
		                    	
		                    				<tr>
		                    					<td><?=$unpaid_money_receipt->invoice_number?></td>
		                    					<td><?=$unpaid_money_receipt->amount?></td>
		                    				</tr>
		                    	<?php			
		                    			}
		                    		}
		                    	?>
		                    	
		                    </tbody>
		                    <tfoot>
		                    	<tr>
		                    		<td colspan="2" style="background: #3c89bd14;text-align: right;">
		                    			Total :: <span id="invoice_total_amount"><?=$total_amount?></span>
		                    		</td>
		                    	</tr>
		                    </tfoot>
		                </table>
		            </div> 

		            <h1>Allocated Invoice</h1> 

		            <div class="table-responsive">
		                <table class="items">
		                    <thead>
		                      <tr>
		                      	<th>Invoice No</th>
		                      	<th>Amount</th>
		                      </tr>
		                    </thead>
		                    <tbody id="allocate-invoice">
		                    	
		                    </tbody>
		                </table>
		            </div> 

		            <br/>
		           	<div class="form-group form-material floating field-smhead-money_receipt_amount" data-plugin="formMaterial">
						<label>Total Amount </label>
						<input type="text" id="total-amount" class="form-control" name="" readonly="true">

					</div>

		        </div>

		        <br/>
		        <div class="form-group" style="margin-top: 20px;display: inline-block;text-align: right;width: 100%;">
			        <?= Html::submitButton($model->isNewRecord ? 'Save Changes' : 'Save Changes', ['class' => $model->isNewRecord ? 'btn-primary waves-effect pull-right' : 'btn-primary waves-effect pull-right']) ?>
			    </div>


		    <?php ActiveForm::end(); ?>    

        </div>  

  </div>
</div>

<script
  src="http://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>

<script type="text/javascript">

	$(document).ready(function(){

			var addedProductCodes = [];

    		$(".unpaid-items tr").click(function() {

				var tableData = $(this).children("td").map(function() {
			        return $(this).text();
			    }).get();

			    var total = Math.round((document.getElementById("total-amount").value)*100)/100;

			    var value = Math.round(($.trim(tableData[1]))* 100 )/100;

			    var preBalance = Math.round((document.getElementById("balance").value)*100)/100 ; 

			    var td_invoiceNumber = $.trim(tableData[0]);

			    var index = $.inArray(td_invoiceNumber, addedProductCodes);

			    if (index >= 0) {
					alert("You already added this Product");
					exit;
				} else {

					if ( preBalance >= value ){

						var data = "<tr><td><input name='sm_invnumber[]' value='"+ $.trim(tableData[0]) +"' style='width: 97%;padding: 3px;border: 1px solid #cccccca3;' readonly></td><td><input name='sm_amount[]' value='"+ value +"' style='width: 97%; text-align: right;    padding: 3px;border: 1px solid #cccccca3;' readonly ></td></tr>";
						$("#allocate-invoice").append(data);

						var balance = Math.round( (preBalance - value) * 100)/100;
				    	document.getElementById("balance").value = balance;
				    	document.getElementById("total-amount").value = Math.round( (value + total)* 100)/100;

					}else if (preBalance < value && preBalance!=0){

						var data = "<tr><td><input name='sm_invnumber[]' value='"+ $.trim(tableData[0]) +"' style='width: 97%;padding: 3px;border: 1px solid #cccccca3;' readonly></td><td><input name='sm_amount[]' value='"+ preBalance  +"' style='width: 97%; text-align: right;    padding: 3px;border: 1px solid #cccccca3;' readonly ></td></tr>";
						$("#allocate-invoice").append(data);

						var balance = Math.round( (preBalance - preBalance)*100)/100;
						document.getElementById("balance").value = balance;
						document.getElementById("total-amount").value = total + preBalance ;
		
					}else{
						alert("Amount is not sufficient");
						exit;
					}

					addedProductCodes.push(td_invoiceNumber);
				}


			});

			$( '#smhead-money_receipt_amount' ).change(function() {
		  
				var invoice_total_amount = Math.round((document.getElementById('invoice_total_amount').innerHTML)*100)/100;
				var amount = Math.round((document.getElementById('smhead-money_receipt_amount').value)*100)/100;

		        if(amount > invoice_total_amount){
		            alert('Amount is bigger than Invoice Amount');
		            document.getElementById('smhead-money_receipt_amount').value = '';
		            
		        }else{
		            document.getElementById('balance').value = amount;
		        }

			});

	});

		

</script>

<style type="text/css">
	.field-smhead-customer_id,
	.field-smhead-branch_id{
		display: none!important;
	}

	.unpaid-items tr{
		border-bottom: 1px solid #ccc;
		cursor: pointer;
	}
	.unpaid-items tr td{
		border: none !important;
	}

</style>
<?php Pjax::end(); ?>

