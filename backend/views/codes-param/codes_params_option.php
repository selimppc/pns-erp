<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\CodesParamSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', $model->type);
$this->params['breadcrumbs'][] = $this->title;
?>
<?php Pjax::begin(); ?> 
<div class="page-header">

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=Url::base('')?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?= Url::toRoute(['/settings']); ?>">Settings</a></li>

        <li class="breadcrumb-item active"><?= Html::encode($this->title) ?></li>
      </ol>
     
      <div class="middle-menu-bar">

        <a href="<?= Url::toRoute(['/codes-param/codes-params-option','type' => $this->title]); ?>" class="">Create <?=$this->title?></a>
  
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
              <?=isset($codes_params_help_text)?$codes_params_help_text:''?>
          </div>
        </div>
     
      <div class="panel-body">

          <div class="form-width-45 pull-left">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

          </div>

          <div class="form-width-45 pull-right">

               <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                      'attribute' => 'code',
                      'format' => 'raw',
                      'value' => function ($model) {
                          return Html::a($model->code, ['/codes-param/view-codes-params', 'id' => $model->id,'type' => $model->type]);
                      },
                    ],
                    [
                      'attribute' => 'title',
                      'format' => 'raw',
                      'value' => function ($model) {
                          return Html::a($model->title, ['/codes-param/view-codes-params', 'id' => $model->id,'type' => $model->type]);
                      },
                    ],
                    'long',                   

                    [
                      'class' => 'yii\grid\ActionColumn',
                      'template' => '{view-codes-params} {update-codes-params} ',
                      'buttons' => [
                        'update-codes-params' => function ($url,$model) {                         

                            $url =  $url. '&type='.$model->type;

                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, ['target' => '_blank']);
                          },

                          'view-codes-params' => function ($url,$model) {

                            $url =  $url. '&type='.$model->type;

                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, ['target' => '_blank']);

                        
                          },
                        
                      ],
                  ],
                ],
            ]); ?>
          
        </div>

      </div>
    </div>
</div>
<?php Pjax::end(); ?>