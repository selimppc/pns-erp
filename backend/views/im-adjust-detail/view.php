<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ImAdjustDetail */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Im Adjust Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-header">

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=Url::base('')?>">Home</a></li>
        <li class="breadcrumb-item active"><?= Html::encode($this->title) ?></li>
      </ol>
      
     
      <div class="middle-menu-bar">
        <?= Html::a(Yii::t('app', 'Create Adjust Details'), ['create'], ['class' => '']) ?>   
        <?= Html::a(Yii::t('app', 'Manage Adjust Details'), ['index'], ['class' => '']) ?> 
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
            <h3 class="panel-title">Update :: <?= Html::encode($this->title) ?></h3>
        </header>

        <div class="panel-body">

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    [
                        'label'  => 'Adjust Head',
                        'value'  => isset($model->imAdjustHead)?$model->imAdjustHead->transaction_no:''
                    ],
                    [
                        'label'  => 'Product',
                        'value'  => isset($model->product)?$model->product->title:''
                    ],                   
                    'batch_number',
                    'expire_date',
                    'uom',
                    'quantity',
                    'stock_rate',
                    
                ],
            ]) ?>

        </div>
    </div>
</div>    
