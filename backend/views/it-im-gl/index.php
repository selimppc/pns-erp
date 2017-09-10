<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ItImGlSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'IM to GL';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-header">

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=Url::base('')?>">Home</a></li>
        <li class="breadcrumb-item">Inventory</li>
        <li class="breadcrumb-item active"><?= Html::encode($this->title) ?></li>
      </ol>
     
      <div class="middle-menu-bar">
        <?= Html::a(Yii::t('app', 'Create '.$this->title), ['create'], ['class' => '']) ?>   
        <?= Html::a(Yii::t('app', 'Manage '.$this->title), ['index'], ['class' => '']) ?>   
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

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'id',

               
                'branch_id',
                'transaction_code',
                'group',
                'dr_coa_id',
                // 'cr_coa_id',

                [
                  'header' => 'Action',
                  'class' => 'yii\grid\ActionColumn',
                  'template' => '{view} {update} ',
                  'buttons' => [
                    'update' => function ($url,$model) {
                        $url =  $url;
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, ['target' => '_blank']);
                      },
                      'view' => function ($url,$model) {
                        $url =  $url;
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, ['target' => '_blank']);
                      },
                    
                  ],
              ],
            ],
        ]); ?>

      </div>

    </div>
</div>      
