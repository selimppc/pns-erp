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
	                                	
				                <?= $form->field($model, 'am_coa_id',
				                	['options' => [
				                    'class' => 'form-group form-material floating',
				                    'data-plugin' => 'formMaterial'
				                	],
				                	 "template" => "<label> Bank/Cash </label>\n{input}\n{hint}\n{error}"
				                	])->textInput(['maxlength' => true]) ?>	


				               <?= $form->field($model, 'money_receipt_amount',
				                	['options' => [
				                    'class' => 'form-group form-material floating',
				                    'data-plugin' => 'formMaterial'
				                	],
				                	 "template" => "<label> Amount </label>\n{input}\n{hint}\n{error}"
				                	])->textInput(['maxlength' => true]) ?>	

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
		                      	<th>Date</th>
		                      </tr>
		                    </thead>
		                    <tbody>
		                    	<tr>

		                    	</tr>
		                    </tbody>
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
		                    <tbody>
		                    	<tr>

		                    	</tr>
		                    </tbody>
		                </table>
		            </div> 

		            <br/>
		           	<div class="form-group form-material floating field-smhead-money_receipt_amount" data-plugin="formMaterial">
						<label>Total Amount </label>
						<input type="text" id="" class="form-control" name="" readonly="true">

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

<style type="text/css">
	.field-smhead-customer_id,
	.field-smhead-branch_id{
		display: none!important;
	}
</style>
<?php Pjax::end(); ?>

