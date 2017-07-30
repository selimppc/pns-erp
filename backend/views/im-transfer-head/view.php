<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ImTransferHead */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Transfer Heads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-header">

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=Url::base('')?>">Home</a></li>
        <li class="breadcrumb-item active"><?= Html::encode($this->title) ?></li>
      </ol>
      
     
      <div class="middle-menu-bar">
        <?= Html::a(Yii::t('app', 'Create Transfer Heads'), ['create'], ['class' => '']) ?>   
        <?= Html::a(Yii::t('app', 'Manage Transfer Heads'), ['index'], ['class' => '']) ?> 
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
                    'transfer_number',
                    'date',
                    'confirm_date',
                    'note:ntext',
                    [
                        'label'  => 'From Branch',
                        'value'  => isset($model->fromBranch)?$model->fromBranch->title:''
                    ],
                    [
                        'label'  => 'From Currency',
                        'value'  => isset($model->fromCurrency)?$model->fromCurrency->title:''
                    ],                  
                    'from_exchange_rate',
                     [
                        'label'  => 'To Branch',
                        'value'  => isset($model->toBranch)?$model->toBranch->title:''
                    ],
                    [
                        'label'  => 'To Currency',
                        'value'  => isset($model->toCurrency)?$model->toCurrency->title:''
                    ],
                    'to_exchange_rate',
                    'status',
                ],
            ]) ?>

        </div>

    </div>
</div>        
