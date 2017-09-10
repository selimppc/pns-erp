<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ImGrnHead */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Grn Heads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-header">

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=Url::base('')?>">Home</a></li>
        <li class="breadcrumb-item active"><?= Html::encode($this->title) ?></li>
      </ol>
      
     
      <div class="middle-menu-bar">
        <?= Html::a(Yii::t('app', 'Grn Heads '), ['create'], ['class' => '']) ?>
        <?= Html::a(Yii::t('app', 'Manage Grn Heads'), ['index'], ['class' => '']) ?> 
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'b']) ?> 

         <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => '',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>
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
            <h3 class="panel-title">View :: <?= Html::encode($this->title) ?></h3>
        </header>
         
        <div class="panel-body">

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'grn_number',
                    [
                        'label'  => 'Purchase Head',
                        'value'  => $model->ppPurchaseHead->po_order_number
                    ],
                    [
                        'label'  => 'Voucher Head',
                        'value'  => $model->amVoucherHead->voucher_number
                    ],
                    [
                        'label'  => 'Supplier',
                        'value'  => $model->supplier->supplier_code
                    ],
                    'date',
                    'pay_terms',
                    [
                        'label'  => 'Branch',
                        'value'  => $model->branch->title
                    ],
                    'tax_rate',
                    'tax_ammount',
                    'discount_rate',
                    'discount_amount',
                    [
                        'label'  => 'Currency',
                        'value'  => $model->currency->title
                    ],
                    'exchnage_rate',
                    'prime_amount',
                    'net_amount',
                    'status',
                ],
            ]) ?>

        </div>

    </div>
</div>        
