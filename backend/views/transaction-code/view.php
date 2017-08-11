<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model backend\models\TransactionCode */

$this->title = $model->type;
$this->params['breadcrumbs'][] = ['label' => 'Transaction Codes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php Pjax::begin(); ?> 
<div class="page-header">

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=Url::base('')?>">Home</a></li>
        <li class="breadcrumb-item active"><?= Html::encode($this->title) ?></li>
      </ol>
      
     
      <div class="middle-menu-bar">
        <?= Html::a(Yii::t('app', 'Create '.$this->title), ['create','type' => $this->title], ['class' => '']) ?>   
       
        <?= Html::a(Yii::t('app', 'Update '.$this->title), ['update','id' => $model->id,'type' => $this->title], ['class' => '']) ?> 
        
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

            <div class="form-width-35 pull-left">

                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'type',
                        'code',
                        'title',
                        'last_number',
                        'increment',
                        'status',
                        
                    ],
                ]) ?>

            </div>


            <div class="form-width-55 pull-right">

                <?= GridView::widget([
                  'dataProvider' => $dataProvider,
                  'filterModel' => $searchModel,
                  'columns' => [
                      ['class' => 'yii\grid\SerialColumn'],
                      'type',
                      'code',                     
                      'last_number',
                      'increment',
                      

                      [
                      'class' => 'yii\grid\ActionColumn',
                      'template' => '{view} {update} ',
                      'buttons' => [
                        'update' => function ($url,$model) {                         

                            $url =  $url. '&type='.$model->type;

                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url);
                          },

                          'view' => function ($url,$model) {

                            $url =  $url. '&type='.$model->type;

                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url);

                        
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