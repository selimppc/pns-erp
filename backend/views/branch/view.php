<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model backend\models\Branch */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Branches'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php Pjax::begin(); ?>
<div class="page-header">

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=Url::base('')?>">Home</a></li>
        <li class="breadcrumb-item">Master Setup</li>
        <li class="breadcrumb-item"><a href="<?= Url::toRoute(['/branch']); ?>">Branch</a></li>
        <li class="breadcrumb-item active"><?= Html::encode($this->title) ?></li>
      </ol>
      
     
      <div class="middle-menu-bar">
        <?= Html::a(Yii::t('app', 'Add New Branch'), ['create'], ['class' => '']) ?>
        <?= Html::a(Yii::t('app', 'Manage Branches'), ['index'], ['class' => '']) ?> 
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
              <b>View ::</b> <?= Html::encode($this->title) ?>
          </div>
        </div>
         
        <div class="panel-body">

            <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'branch_code',
            'title',
            [
                'label'  => 'Currency',
                'value'  => $model->currency->title
            ],
            'exchange_rate',
            'contact_person',
            'designation',
            'mailing_addess:ntext',
            'phone',
            'fax',
            'cell',
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
<?php Pjax::end(); ?>