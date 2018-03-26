<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\bootstrap\ActiveForm;
use backend\models\SmHead;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $model backend\models\SmHead */

$this->title = 'Sales Return';
$this->params['breadcrumbs'][] = ['label' => 'Sm Heads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-header">

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=Url::base('')?>">Home</a></li>
        <li class="breadcrumb-item">Sales</li>

        <li class="breadcrumb-item active"><a href="<?= Url::toRoute(['/sales-invoice']); ?>"><?= Html::encode($this->title) ?></a></li>
      </ol>
     
      <div class="middle-menu-bar">
        <?= Html::a(Yii::t('app', 'Choose Invoice for'.$this->title), ['choose-invoice'], ['class' => '']) ?>   
        <?= Html::a(Yii::t('app', 'Manage '.$this->title), ['index'], ['class' => '']) ?>   
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
              <b>Sales Return</b> :: Please choose invoice number which you want to return             
          </div>
      </div>

      <div class="panel-body">

        <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

            <div class="col-md-5">
              <label>Invoice List</label>
              <?php

                echo Select2::widget([
                  'name' => 'invoice',
                  'value' => '',
                  'data' => ArrayHelper::map(SmHead::find()->where(['doc_type' => 'sales'])->andWhere(['status'=> 'confirmed'])->all(),'id','sm_number'),
                  'options' => ['multiple' => false, 'placeholder' => 'Select invoice ...','required'=>'required']
              ]);

              ?>
            </div>
            
            <div class="col-md-1">  
              <label>&nbsp;</label>
              <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>

            </div>  

          <?php ActiveForm::end(); ?>
	    </div>

    </div>
    
</div>

<style type="text/css">
  .select2-container--krajee .select2-selection--single {
    height: 35px !important;
    padding: 7px 24px 6px 10px;
}

.select2-container--krajee .select2-selection--single .select2-selection__arrow {
    height: 33px !important;
    border-left: 1px solid #cccccc96;
}
</style>      
