
<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model backend\models\CodesParam */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Codes Params'), 'url' => ['index']];
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

        <a href="<?= Url::toRoute(['/codes-param/codes-params-option','type' => $model->type]); ?>" class="">Create <?=$model->type?></a>
        
        <?= Html::a(Yii::t('app', 'Update '.$model->title), ['update-codes-params', 'id' => $model->id,'type' => $model->type], ['class' => '']) ?> 

         
        <?php
          echo \yii\helpers\Html::a( '<i class="icon md-arrow-left" aria-hidden="true"></i> Back', Yii::$app->request->referrer,['class' => 'back']);
        ?>    
      </div>
</div>



<div class="page-content">
    <!-- Panel Basic -->
    <div class="panel">

        <div id="flag_desc">
          <div id="flag_desc_text">
              <b>View ::</b> <?= Html::encode($this->title) ?>
          </div>
        </div>

         
        <div class="panel-body">

        	<div class="form-width-45 pull-left">

	            <?= DetailView::widget([
	                'model' => $model,
	                'attributes' => [
	                    'id',
	                    'type',
	                    'code',
	                    'title',	                    
	                    'long',
	                    'status',
	                ],
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

                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url);
                          },

                          'view-codes-params' => function ($url,$model) {

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