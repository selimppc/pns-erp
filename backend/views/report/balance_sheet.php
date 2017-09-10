<?php
	use yii\helpers\Url;	
	use yii\helpers\Html;
	use yii\widgets\ActiveForm;
	use backend\models\TransactionCode;
	use backend\models\Branch;
	use yii\helpers\ArrayHelper;
	use kartik\date\DatePicker;
	use yii\widgets\Pjax;

	$this->title = Yii::t('app', $title);
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

	    			<div class="col-md-3">
			    		<?= $form->field($model, 'year')
                        ->dropDownList(
                            array ('2017'=>'2017', '2018'=>'2018','2019' => '2019','2020' => '2020'),
                            array ('class'=>'form-control','prompt'=>'-Select Year-') 
                        ); ?>	
		            </div>

		            <div class="col-md-3">
			    		<?= $form->field($model, 'month')
                        ->dropDownList(
                            array ('1'=>'Jan', '2'=>'Feb','3' => 'Mar','4' => 'Apr','5' => 'May', '6' => 'Jun','7' => 'Jul', '8' => 'Aug', '9' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dec'),
                            array ('class'=>'form-control','prompt'=>'-Select Month-') 
                        ); ?>	
		            </div>

		            <div class="col-md-3">
			    		<div class="form-group form-material" data-plugin="formMaterial">

			                <?= $form->field($model, 'branch')
				                        ->dropDownList(
				                            ArrayHelper::map(Branch::find()->all(), 'id', 'branch_code'),
				                             ['class'=>'form-control floating','prompt'=>'-Select Branch-',]
				                        ); ?>

			            </div>	
		            </div>

		            <div class="col-md-3">
			    		<?= $form->field($model, 'report_type')
                        ->dropDownList(
                            array ('Detail'=>'Detail', 'Summary'=>'Summary'),
                            array ('class'=>'form-control') 
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
<?php Pjax::end(); ?>