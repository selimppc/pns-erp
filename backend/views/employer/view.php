<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model backend\models\SalesPerson */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Employer', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php Pjax::begin(); ?>

    <div class="page-header">

          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?=Url::base('')?>">Home</a></li>
            <li class="breadcrumb-item">Administrator</li>
            <li class="breadcrumb-item"><a href="<?= Url::toRoute(['/employer']); ?>">Employer</a></li>
            <li class="breadcrumb-item active"><?= Html::encode($this->title) ?></li>
          </ol>
          
         
          <div class="middle-menu-bar">
            <?= Html::a(Yii::t('app', 'Add New Employer'), ['create'], ['class' => '']) ?>
            <?= Html::a(Yii::t('app', 'Manage Employer'), ['index'], ['class' => '']) ?> 
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
                        'employer_code',
                        'name',
                        'api_id',
                        'address:ntext',
                        'terotorry',
                        'type',
                        'cell',
                        'phone',
                        'fax',
                        'email:email',
                        [
                            'label'  => 'Branch',
                            'value'  => isset($model->branch)?$model->branch->title:''
                        ],
                        'market',
                        'credit_limit',
                        'hub',
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