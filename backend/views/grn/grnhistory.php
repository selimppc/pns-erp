<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\ImGrnHead;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ImGrnHeadSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'GRN History';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-header">

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=Url::base('')?>">Home</a></li>
        <li class="breadcrumb-item">Inventory</li>
        <li class="breadcrumb-item active"><?= Html::encode($this->title) ?></li>
      </ol>
     
      <div class="middle-menu-bar">
        <?= Html::a(Yii::t('app', 'GRN History (PO Lists)'), ['/grn/grn-history'], ['class' => '']) ?>
        <?= Html::a(Yii::t('app', 'Manage GRN'), ['/grn/manage-grn'], ['class' => '']) ?>   
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
      	
      		<?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                #['class' => 'yii\grid\SerialColumn'],
                'id',
                [
                  'attribute' => 'po_order_number',
                  'label' => 'Purchase Order No',
                  'format' => 'raw',
                  'value' => function ($model) {
                      return Html::a($model->po_order_number, ['/purchase-order/view', 'id' => $model->id]);
                  },
                ],
                [
                 'label' => 'Supplier Id',
                 'value' => function ($model) {
                     return isset($model->supplier)?$model->supplier->supplier_code:'';
                 }
               ],
               [
                 'label' => 'Supplier Organization Name',
                 'value' => function ($model) {
                     return isset($model->supplier)?$model->supplier->org_name:'';
                 }
               ],
                [
                 'label' => 'Order Date',
                 'value' => function ($model) {
                     return $model->date;
                 }
               ],
                'delivery_date',
               
                [
                  'label' => 'PO Status',
                  'value' => function ($model){

                    $grn_data_exists = ImGrnHead::find()->where(['pp_purchase_head_id'=>$model->id])->one();

                    if(empty($grn_data_exists)){
                      return ucfirst($model->status);
                    }else{
                      return ucfirst('GRN '.$grn_data_exists->status);
                    }
                    
                  }
                ],
                [
                    'header' => 'Action',
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{create_grn}',
                    'buttons' => [
                     
                        'create_grn' => function ($url, $model) use ($grn_transaction_number) {

                              $grn_data_exists = ImGrnHead::find()->where(['pp_purchase_head_id'=>$model->id])->one();

                              if(empty($grn_data_exists)){

                                return Html::a('Create GRN', ['grn/create-grn', 'po' => $model->po_order_number,'grn' => $grn_transaction_number], ["class"=>"btn btn-xs btn-success", "data-pjax" => 0, 'onClick' => 'return confirm("Are you sure you want to create this GRN?") ']);
                                  
                              }
                              
                          },
                      
                    ],
                ],


            ],
        ]); ?>

      </div>

</div>      