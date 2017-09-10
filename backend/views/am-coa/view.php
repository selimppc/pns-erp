<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model backend\models\AmCoa */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Chart of Account'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php Pjax::begin(); ?> 
<div class="page-header">

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=Url::base('')?>">Home</a></li>
        <li class="breadcrumb-item">General Ledger</li>
        <li class="breadcrumb-item">Chart of Account</li>
        <li class="breadcrumb-item active"><?= Html::encode($this->title) ?></li>
      </ol>
      
     
      <div class="middle-menu-bar">
        <?= Html::a(Yii::t('app', 'Add New Chart of Account'), ['create'], ['class' => '']) ?>
        <?= Html::a(Yii::t('app', 'Manage Chart of Account'), ['index'], ['class' => '']) ?> 
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'b']) ?> 
      
        <?php
          echo \yii\helpers\Html::a( '<i class="icon md-arrow-left" aria-hidden="true"></i> Back', Yii::$app->request->referrer,['class' => 'back']);
        ?>    
      </div>
</div>

<div class="page-content">
    <!-- Panel Basic -->
    <div class="panel">

    <?php 
        if(Yii::$app->session->hasFlash('success')){
    ?>
        <div class="alert alert-success">
          <?= Yii::$app->session->getFlash('success'); ?>
        </div>
    <?php 
        }
    ?>

    <?php 
        if(Yii::$app->session->hasFlash('error')){
    ?>
        <div class="alert alert-danger">
          <?= Yii::$app->session->getFlash('error'); ?>
        </div>
    <?php 
        }
    ?>

    <div id="flag_desc">
      <div id="flag_desc_text">
          View :: <?= Html::encode($this->title) ?>
      </div>
    </div>

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
                'value'  => isset($model->groupOne)?$model->groupOne->title:''
            ],
            [
                'label'  => 'Group Two',
                'value'  => isset($model->groupTwo)?$model->groupTwo->title:''
            ],
            
            'analyical_code',
            [
                'label'  => 'Branch',
                'value'  => isset($model->branch)?$model->branch->title:''
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
<?php Pjax::end(); ?>