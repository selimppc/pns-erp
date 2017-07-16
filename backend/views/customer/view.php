<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Customer */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Customers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-header">

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=Url::base('')?>">Home</a></li>
        <li class="breadcrumb-item active"><?= Html::encode($this->title) ?></li>
      </ol>
      
     
      <div class="middle-menu-bar">
        <?= Html::a(Yii::t('app', 'Create Customer'), ['create'], ['class' => '']) ?>   
        <?= Html::a(Yii::t('app', 'Manage Customers'), ['index'], ['class' => '']) ?> 
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
                    'customer_code',
                    'name',
                    'api_id',
                    'address:ntext',
                    'terotorry',
                     [
                        'label'  => 'Group One',
                        'value'  => $model->groupOne->title
                    ],
                    'type',
                    'cell',
                    'phone',
                    'fax',
                    'email:email',
                    [
                        'label'  => 'Branch',
                        'value'  => $model->branch->title
                    ],
                    'market',
                    'sales_person',
                    'credit_limit',
                    'hub',
                    'status',
                    'created_by',
                    'updated_by',
                    'created_at',
                    'updated_at',
                ],
            ]) ?>

        </div>

    </div>    
</div>    
