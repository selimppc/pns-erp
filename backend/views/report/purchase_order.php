<?php
	use yii\helpers\Url;	
	use yii\helpers\Html;
	use yii\widgets\ActiveForm;
	use backend\models\PpPurchaseHead;
	use yii\helpers\ArrayHelper;
	use kartik\date\DatePicker;

	$this->title = Yii::t('app', $title);
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

	    			<div class="col-md-4">
			    		<div class="form-group form-material" data-plugin="formMaterial">

			                <?= $form->field($model, 'purchase_order')
				                        ->dropDownList(
				                            ArrayHelper::map(PpPurchaseHead::find()->all(), 'id', 'po_order_number'),
				                             ['class'=>'form-control floating','prompt'=>'-Select PO Number-',]
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