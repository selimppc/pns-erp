<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\GroupThree */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Group Threes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-header">

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=Url::base('')?>">Home</a></li>

        <li class="breadcrumb-item"><a>Master Setup</a></li>

        <li class="breadcrumb-item"><a href="<?= Url::toRoute(['/settings']); ?>">Settings</a></li>

        <li class="breadcrumb-item"><a>Group Master</a></li>

        <li class="breadcrumb-item active"><?= Html::encode($this->title) ?></li>
      </ol>
      
     
      <div class="middle-menu-bar">
        <?= Html::a(Yii::t('app', 'Create GroupThree'), ['create'], ['class' => '']) ?>   
        <?= Html::a(Yii::t('app', 'Manage GroupThree'), ['index'], ['class' => '']) ?> 
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'b']) ?> 

        <?php
          echo \yii\helpers\Html::a( '<i class="icon md-arrow-left" aria-hidden="true"></i> Back', Yii::$app->request->referrer,['class' => 'back']);
        ?>    
      </div>
</div>

<div class="page-content">
    <!-- Panel Basic -->
    <div class="panel">

        <div class="panel-body">

              <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                     [
                        'label'  => 'Group Two',
                        'value'  => $model->groupTwo->title
                    ],
                    'title',
                    'description:ntext',
                   # 'created_by',
                   # 'updated_by',
                   # 'created_at',
                   # 'updated_at',
                ],
            ]) ?>

        </div>

    </div>
</div>
