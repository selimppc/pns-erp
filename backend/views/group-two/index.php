<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\GroupTwoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Group Two');
$this->params['breadcrumbs'][] = $this->title;
?>
<?php Pjax::begin(); ?> 
<div class="page-header">

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=Url::base('')?>">Home</a></li>

        <li class="breadcrumb-item"><a>Master Setup</a></li>

        <li class="breadcrumb-item"><a href="<?= Url::toRoute(['/settings']); ?>">Settings</a></li>

        <li class="breadcrumb-item active"><?= Html::encode($this->title) ?></li>
      </ol>
     
      <div class="middle-menu-bar">
        <?= Html::a(Yii::t('app', 'Add New Group Two'), ['create'], ['class' => '']) ?>
        <?= Html::a(Yii::t('app', 'Manage Group Twos'), ['index'], ['class' => '']) ?>   
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
              <?php
                  if(isset(\Yii::$app->params['group_two_index']) && !empty(\Yii::$app->params['group_two_index'])){
                    echo \Yii::$app->params['group_two_index'];
                  }
              ?>
          </div>
      </div>
     
      <div class="panel-body">

        
              <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                   'id',
                    [
                       'label'=>'Group One',
                       'format' => 'raw',
                       'value'=>function ($data) {
                            return $data->groupOne->title;
                        },
                    ],
                    [
                      'attribute' => 'title',
                      'format' => 'raw',
                      'value' => function ($model) {
                            return Html::a($model->title, ['/group-four/view', 'id' => $model->id]);
                        },
                    ],
                    'description:ntext',
                    //'created_by',
                    // 'updated_by',
                    // 'created_at',
                    // 'updated_at',

                    [
                      'class' => 'yii\grid\ActionColumn',
                      'template' => '{view} {update} ',
                    ],
                ],
            ]); ?>
        

      </div>

    </div>
</div>
<?php Pjax::end(); ?>