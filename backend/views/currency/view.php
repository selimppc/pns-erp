<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Currency */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Currency'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-header">

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=Url::base('')?>">Home</a></li>
        <li class="breadcrumb-item">Master Setup</li>
        <li class="breadcrumb-item"><a href="<?= Url::toRoute(['/currency']); ?>">Currency</a></li>
        <li class="breadcrumb-item active"><?= Html::encode($this->title) ?></li>
      </ol>
      
     
      <div class="middle-menu-bar">
        <?= Html::a(Yii::t('app', 'Create Currency'), ['create'], ['class' => '']) ?>   
        <?= Html::a(Yii::t('app', 'Manage Currency'), ['index'], ['class' => '']) ?> 
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
                    'currency_code',
                    'title',
                    'exchange_rate',
                    'status',
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
</div>   
