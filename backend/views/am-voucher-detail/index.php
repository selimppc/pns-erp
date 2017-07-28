<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AmVoucherDetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Voucher Details';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-header">

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=Url::base('')?>">Home</a></li>
        <li class="breadcrumb-item active"><?= Html::encode($this->title) ?></li>
      </ol>
     
      <div class="middle-menu-bar">
        <?= Html::a(Yii::t('app', 'Create Voucher Details'), ['create'], ['class' => '']) ?>   
        <?= Html::a(Yii::t('app', 'Manage Voucher Details'), ['index'], ['class' => '']) ?> 

        <?= Html::a(Yii::t('app', 'Create Voucher Head'), ['/am-voucher-head'], ['class' => '']) ?>   
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
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'am_voucher_head_id',
                    'am_coa_id',
                    'am_sub_coa_id',
                    'currency_id',
                    // 'exchange_rate',
                    // 'prime_amount',
                    // 'base_amount',
                    // 'branch_id',
                    // 'note:ntext',
                    // 'status',
                    // 'created_by',
                    // 'updated_by',
                    // 'created_at',
                    // 'updated_at',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>

        </div>

    </div>
</div>        

