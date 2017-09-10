<?php
	use yii\helpers\Url;	
	use yii\helpers\Html;
	use yii\widgets\ActiveForm;
	use backend\models\TransactionCode;
	use backend\models\Branch;
	use yii\helpers\ArrayHelper;
	use kartik\date\DatePicker;

	$this->title = Yii::t('app', 'Transaction');
	$this->params['breadcrumbs'][] = $this->title;
?>

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

      <header class="panel-heading">
        <div class="panel-actions"></div>
        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
      </header>
     
	    <div class="panel-body">

	    	<?php $form = ActiveForm::begin(); ?>

	    		<div class="row">

	    			<div class="col-md-2">
			    		<div class="form-group form-material" data-plugin="formMaterial">

			                <?= $form->field($model, 'transaction_code')
				                        ->dropDownList(
				                            ArrayHelper::map(TransactionCode::find()->all(), 'id', 'code'),
				                             ['class'=>'form-control floating','prompt'=>'-Select Transaction-',]
				                        ); ?>

			            </div>	
		            </div>

		            <div class="col-md-2">
			    		<div class="form-group form-material" data-plugin="formMaterial">

			                <?= $form->field($model, 'branch')
				                        ->dropDownList(
				                            ArrayHelper::map(Branch::find()->all(), 'id', 'branch_code'),
				                             ['class'=>'form-control floating','prompt'=>'-Select Branch-',]
				                        ); ?>

			            </div>	
		            </div>

		            <div class="col-md-2">

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

		  			<div class="col-md-2">

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

		  			<div class="col-md-2">
			    		<?= $form->field($model, 'transaction_status')
                        ->dropDownList(
                            array ('Open'=>'Open', 'Balanced'=>'Balanced','Suspend' => 'Suspend','Posted' => 'Posted'),
                            array ('class'=>'form-control','prompt'=>'-Select Status-') 
                        ); ?>	
		            </div>

	    			<div class="report-button">

		            	<input class="action-btn" id="action-btn-pdf" name="topdf" style="margin-right: 10px;" type="submit" value="PDF">

		            	<input class="action-btn" id="action-btn-xls" name="toxls" type="submit" value="XLS">

		            </div>

	    		</div>

	    	<?php ActiveForm::end(); ?>

	    </div>

	</div>
</div>	    