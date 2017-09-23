<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ImGrnDetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Payment';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-header">

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=Url::base('')?>">Home</a></li>
        <li class="breadcrumb-item">Account Payable</li>
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

    	<div id="flag_desc">
          <div id="flag_desc_text">
              <?php
                if(isset(\Yii::$app->params['account_payable_payment']) && !empty(\Yii::$app->params['account_payable_payment'])){
                  echo \Yii::$app->params['account_payable_payment'];
                }
              ?>              
          </div>
        </div>


        <div class="panel-body">

        

        <div class="table-responsive">

          <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            

            'columns' => [
                #['class' => 'yii\grid\SerialColumn'],

                [
	               'attribute' => 'supplier_id',  
	               'label' => 'Supplier',
	               'value' => function ($model) {
	                   return isset($model->supplier)?$model->supplier->supplier_code:'';
	               }
	            ],
                'org_name',
                [
                   'attribute' => 'branch_id',  
                   'label' => 'Delivery to Branch',
                   'value' => function ($model) {
                       return isset($model->branch)?$model->branch->title:'';
                   }
                ],                
                [
                   'attribute' => 'am_coa_id',  
                   'label' => 'Account Code',
                   'value' => function ($model) {
                       return isset($model->amCoa)?$model->amCoa->account_code:'';
                   }
                ],
                'coa_title',
                'contct_person',
                'payable_amount',
               
               
                #['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>

           

          </div>
          
      </div>

    </div>
</div>
