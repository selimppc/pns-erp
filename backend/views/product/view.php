<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-header">

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=Url::base('')?>">Home</a></li>
        <li class="breadcrumb-item">Master Setup</li>
        <li class="breadcrumb-item">View</li>
        <li class="breadcrumb-item active"><?= Html::encode($this->title) ?></li>
      </ol>
      
     
      <div class="middle-menu-bar">
        <?= Html::a(Yii::t('app', 'Create Product'), ['create'], ['class' => '']) ?>   
        <?= Html::a(Yii::t('app', 'Manage Products'), ['index'], ['class' => '']) ?> 
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
        <h3 class="panel-title">Update :: <?= Html::encode($this->title) ?></h3>
    </header>
     
    <div class="panel-body">

        <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'product_code',
            'title',
            'description:ntext',
            
            [
                'label'  => 'Product Class',
                'value'  => isset($model->product_class)?$model->product_class->title:''
            ],
            [
                'label'  => 'Product Group',
                'value'  => isset($model->product_group)?$model->product_group->title:''
            ],
                     
            [
                'label'  => 'Currency',
                'value'  => isset($model->currency)?$model->currency->title:''
            ],
            'origin', 
            'stock_type', 
            'model',
            'size', 
            [
                'label'  => 'Created By',
                'value'  => isset($model->createdBy)?$model->createdBy->email:''
            ],
            [
                'label'  => 'Updated By',
                'value'  => isset($model->updatedBy)?$model->updatedBy->email:''
            ],             
            'created_at',
            'updated_at',
        ],
    ]) ?>

    </div>

</div>

