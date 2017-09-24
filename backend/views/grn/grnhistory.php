<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\ImGrnHead;
use yii\bootstrap\Modal;

use yii\helpers\ArrayHelper;

use backend\models\Supplier;
use backend\models\Branch;
use backend\models\Currency;

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

      <div id="flag_desc">
            <div id="flag_desc_text">
                <?php
                    if(isset(\Yii::$app->params['grn_history']) && !empty(\Yii::$app->params['grn_history'])){
                      echo \Yii::$app->params['grn_history'];
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
                'id',
                [
                  'attribute' => 'po_order_number',
                  'label' => 'Purchase Order No',
                  'format' => 'raw',
                  'value' => function ($model) {
                      return Html::a($model->po_order_number, ['/purchase-order/view-popup', 'id' => $model->id],['class'=>'modalButton']);
                  },
                ],
                [
                 'attribute' => 'supplier_id',
                 'label' => 'Supplier',
                 'filter'=>ArrayHelper::map(Supplier::find()->asArray()->all(), 'id', 'supplier_code'),
                 'value' => function ($model) {
                     return isset($model->supplier)?$model->supplier->supplier_code:'';
                 }
               ],
               [
                 'attribute' => 'supplier_id',
                 'label' => 'Supplier Name',
                 'filter'=>ArrayHelper::map(Supplier::find()->asArray()->all(), 'id', 'org_name'),
                 'value' => function ($model) {
                     return isset($model->supplier)?$model->supplier->org_name:'';
                 }
               ],
                [
                 'attribute' => 'date',
                 'label' => 'Order Date',
                 'value' => function ($model) {
                     return $model->date;
                 }
               ],
                'delivery_date',
               
                [
                  'attribute' => 'status',
                  'label' => 'PO Status',
                  'filter'=>array("open"=>"Open","grn-created"=>"Grn-created","approved"=>"Approved","part-received"=>"Part-received"),
                  'value' => function ($model){

                    $grn_data_exists = ImGrnHead::find()->where(['pp_purchase_head_id'=>$model->id])->one();

                    if(empty($grn_data_exists)){
                      return ucfirst($model->status);
                    }else{
                      return 'Grn '.ucfirst($grn_data_exists->status);
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

                                return Html::a('Create GRN', ['grn/create-grn', 'po' => $model->po_order_number], ["class"=>"btn btn-xs btn-success", "data-pjax" => 0, 'onClick' => 'return confirm("Are you sure you want to create this GRN?") ']);
                                  
                              }
                              
                          },
                      
                    ],
                ],


            ],
        ]); ?>  

        <!-- We don't need to print modal popup multiple times -->
      <?php 
        Modal::begin([
            'header' => 'Purchase Order Details',
            'id' => 'modal',
            'size' => 'modal-lg',
        ]);
        echo "<div id='modalContent'></div>";
        Modal::end();
      ?>

        </div>

      </div>

</div>      

<?php
    
    $this->registerJs("

      // changed id to class
      $('.modalButton').click(function (){

          $.get($(this).attr('href'), function(data) {
              $('#modal').modal('show').find('#modalContent').html(data);
          });

         return false;
      });

    ", yii\web\View::POS_READY, "modal_open");   
?>