<?php
	use yii\helpers\Url;	
	use yii\helpers\Html;
	use yii\widgets\ActiveForm;
	use backend\models\Customer;
	use yii\helpers\ArrayHelper;
	use kartik\date\DatePicker;
	use yii\widgets\Pjax;

	$this->title = Yii::t('app', 'Customer List');
	$this->params['breadcrumbs'][] = $this->title;
?>
<?php Pjax::begin(); ?> 
<div class="page-header">

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=Url::base('')?>">Home</a></li>
        <li class="breadcrumb-item"><a>Master Setup</a></li>
        <li class="breadcrumb-item"><a>Report</a></li>
        <li class="breadcrumb-item active"><?=$this->title?></li>
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

      <div id="flag_desc">
          <div id="flag_desc_text">
              <?=isset($report_help_text)?$report_help_text:''?>
          </div>
      </div>
     
	  <div class="panel-body">

	  	<?php $form = ActiveForm::begin(); ?>

	  		<div class="row">

	  			<div class="col-md-4">
		    		<div class="form-group form-material" data-plugin="formMaterial">

		                <?= $form->field($model, 'customer')
			                        ->dropDownList(
			                            ArrayHelper::map(Customer::find()->all(), 'id', 'customer_code'),
			                             ['class'=>'form-control floating','prompt'=>'-Select Customer Code-',]
			                        ); ?>

		            </div>	
	            </div>

	  			<div class="col-md-4">

	  				<?php
			    		echo '<label>From Date</label>';
						echo DatePicker::widget([
							'name' => 'from_date', 
							'value' => date('Y-m-d'),
							'options' => ['placeholder' => 'Select issue date ...'],
							'pluginOptions' => [
								'format' => 'yyyy-m-dd',
								'todayHighlight' => true
							]
						]);
			    	?>

	  			</div>

	  			<div class="col-md-4">

	  				<?php
			    		echo '<label>To Date</label>';
						echo DatePicker::widget([
							'name' => 'to_date', 
							'value' => date('Y-m-d'),
							'options' => ['placeholder' => 'Select issue date ...'],
							'pluginOptions' => [
								'format' => 'yyyy-m-dd',
								'todayHighlight' => true
							]
						]);
			    	?>

	  			</div>

	  		</div>

	  		<div class="report-button">

            	<input class="action-btn" id="action-btn-pdf" name="topdf" style="margin-right: 10px;" type="submit" value="PDF">

            	<input class="action-btn" id="action-btn-xls" name="toxls" type="submit" value="XLS">

            </div>

	  	<?php ActiveForm::end(); ?>

	  </div>

	</div>
</div>	  
<?php Pjax::end(); ?>