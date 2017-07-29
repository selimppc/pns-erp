<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\AmCoa */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Chart of Account'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-header">

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=Url::base('')?>">Home</a></li>
        <li class="breadcrumb-item active"><?= Html::encode($this->title) ?></li>
      </ol>
      
     
      <div class="middle-menu-bar">
        <?= Html::a(Yii::t('app', 'Create Chart of Account'), ['create'], ['class' => '']) ?>   
        <?= Html::a(Yii::t('app', 'Manage Chart of Account'), ['index'], ['class' => '']) ?> 
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
            'account_code',
            'title',
            'description:ntext',
            'account_type',
            'account_usage',
            [
                'label'  => 'Group One',
                'value'  => $model->groupOne->title
            ],
            [
                'label'  => 'Group Two',
                'value'  => $model->groupTwo->title
            ],
            [
                'label'  => 'Group Three',
                'value'  => $model->groupThree->title
            ],
           [
                'label'  => 'Group Four',
                'value'  => $model->groupFour->title
            ],
            'analyical_code',
            [
                'label'  => 'Branch',
                'value'  => $model->branch->title
            ],
            'status',
           # 'created_by',
           # 'updated_by',
           # 'created_at',
            #'updated_at',
        ],
    ]) ?>

    </div>

</div>
