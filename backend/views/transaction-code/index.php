<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TransactionCodeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $model->type;
$this->params['breadcrumbs'][] = $this->title;
?>
<?php Pjax::begin(); ?> 
<div class="page-header">

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=Url::base('')?>">Home</a></li>
        <li class="breadcrumb-item">Settings</li>
        <li class="breadcrumb-item active"><?= Html::encode($this->title) ?></li>
      </ol>
     
      <div class="middle-menu-bar">
        <?= Html::a(Yii::t('app', 'Create '.$this->title), ['create','type' => $this->title], ['class' => '']) ?>   
        
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
              <?=isset($transaction_code_help_text)?$transaction_code_help_text:''?>
          </div>
        </div>
       
        <div class="panel-body">

            <div class="form-width-40 pull-left">

              <?= $this->render('_form', [
                  'model' => $model,
              ]) ?>

            </div>

            <div class="form-width-55 pull-right">

                <?= GridView::widget([
                  'dataProvider' => $dataProvider,
                  'filterModel' => $searchModel,
                  'columns' => [
                    #  ['class' => 'yii\grid\SerialColumn'],
                      'id',
                      
                      [
                       # 'attribute' => 'type',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return $model->type;
                        },
                      ], 
                      [
                        'attribute' => 'code',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return Html::a($model->code, ['/transaction-code/view', 'id' => $model->id,'type' => $model->type]);
                        },
                      ],                      
                      'last_number',
                      'increment',
                      

                      [
                      'class' => 'yii\grid\ActionColumn',
                      'template' => '{view} {update} ',
                      'buttons' => [
                        'update' => function ($url,$model) {                         

                            $url =  $url. '&type='.$model->type;

                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, ['target' => '_blank']);
                          },

                          'view' => function ($url,$model) {

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