<?php
	use yii\helpers\Url;	
	use yii\helpers\Html;
	use yii\widgets\ActiveForm;
	use backend\models\CodesParam;
	use yii\helpers\ArrayHelper;
	use yii\widgets\Pjax;

	$this->title = Yii::t('app', 'Product List');
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
				    		<?= $form->field($model, 'account_type')
                            ->dropDownList(
                                array ('Asset'=>'Asset', 'Liability'=>'Liability','Income' => 'Income','Expenses' => 'Expenses'),
                                array ('class'=>'form-control','prompt'=>'-Select Account Type-') 
                            ); ?>	
			            </div>


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