<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\GroupFourSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Group Fours');
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
        <?= Html::a(Yii::t('app', 'Create Group Fours'), ['create'], ['class' => '']) ?>   
        <?= Html::a(Yii::t('app', 'Manage Group Fours'), ['index'], ['class' => '']) ?>   
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
        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
      </header>
     
      <div class="panel-body">

        <?php Pjax::begin(); ?>   

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                [
                 'label'=>'Group Three',
                 'format' => 'raw',
                 'value'=>function ($data) {
                      return $data->groupThree->title;
                  },
                ],
                'title',
                'description:ntext',

                [
                  'class' => 'yii\grid\ActionColumn',
                  'template' => '{view} {update} ',
                ],
            ],
        ]); ?>
        <?php Pjax::end(); ?>

      </div>

    </div>
</div>      

