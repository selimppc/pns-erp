<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\AmVoucherDetail */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Voucher', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-header">

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=Url::base('')?>">Home</a></li>
        <li class="breadcrumb-item">General Ledger</li>
        <li class="breadcrumb-item active"><?= Html::encode($this->title) ?></li>
      </ol>
      
     
      <div class="middle-menu-bar">
        <?= Html::a(Yii::t('app', 'Add New Voucher'), ['create'], ['class' => '']) ?>
        <?= Html::a(Yii::t('app', 'Manage Voucher'), ['index'], ['class' => '']) ?> 
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'b']) ?> 

       
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
                    'am_voucher_head_id',
                    [
                        'label'  => 'Coa',
                        'value'  => isset($model->amCoa)?$model->amCoa->title:''
                    ],
                    [
                        'label'  => 'Sub Coa',
                        'value'  => isset($model->amSubCoa)?$model->amSubCoa->title:''
                    ],
                    [
                        'label'  => 'Currency',
                        'value'  => isset($model->currency)?$model->currency->title:''
                    ],
                    'exchange_rate',
                    'prime_amount',
                    'base_amount',
                    [
                        'label'  => 'Branch',
                        'value'  => isset($model->branch)?$model->branch->title:''
                    ],
                    'note:ntext',
                    'status',
                ],
            ]) ?>

        </div>

    </div>
</div> 