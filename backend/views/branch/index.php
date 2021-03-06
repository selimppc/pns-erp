<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

use yii\helpers\ArrayHelper;

use backend\models\CodesParam;
use backend\models\Currency;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BranchSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Branches');
$this->params['breadcrumbs'][] = $this->title;
?>
<?php Pjax::begin(); ?>
<div class="page-header">

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=Url::base('')?>">Home</a></li>
        <li class="breadcrumb-item">Master Setup</li>
        <li class="breadcrumb-item active"><?= Html::encode($this->title) ?></li>
      </ol>
     
      <div class="middle-menu-bar">
        <?= Html::a(Yii::t('app', 'Add New Branch'), ['create'], ['class' => '']) ?>
        <?= Html::a(Yii::t('app', 'Manage Branches'), ['index'], ['class' => '']) ?>   
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
              <?=\Yii::$app->params['branch_master_index']?>
          </div>
      </div>
     
      <div class="panel-body">

        <div class="table-responsive">

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
             #       ['class' => 'yii\grid\SerialColumn'],
                    'id',
                    [
                      'attribute' => 'branch_code',
                      'format' => 'raw',
                      'value' => function ($model) {
                          return Html::a($model->branch_code, ['/branch/view', 'id' => $model->id]);
                      },
                    ],
                    [
                      'attribute' => 'title',
                      'format' => 'raw',
                      'value' => function ($model) {
                          return Html::a($model->title, ['/branch/view', 'id' => $model->id]);
                      },
                    ],                    
                    
                    [
                     'attribute' => 'currency_id',
                     'label'=>'Currency',
                     'filter'=>ArrayHelper::map(Currency::find()->asArray()->all(), 'id', 'currency_code'),
                     'format' => 'raw',
                     'value'=>function ($data) {
                          return $data->currency->currency_code;
                      },
                    ],

                    [
                     'attribute' => 'exchange_rate',
                     'label'=>'Exchange Rate',
                     'format' => 'raw',
                     'value'=>function ($model) {
                          return number_format($model->exchange_rate,3);
                      },
                    ],
                    'contact_person',
                    'designation',
                    'mailing_addess',
                    'phone',
                    'cell',
                    [
                        'attribute' => 'status',
                        'label' => 'Status',
                        'filter'=>array("active"=>"Active","inactive"=>"Inactive","cancel"=>"Cancel"),
                        'value' => function ($model){
                            return ucfirst($model->status);
                        }
                    ],

                    [
                        'header' => 'Action',
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{view} {update} ',
                        'buttons' => [
                          'update' => function ($url,$model) {
                              $url =  $url;
                              return Html::a('<span class="btn btn-xs btn-primary" title="Update">Edit </span>', $url, ['target' => '_blank']);
                            },
                            'view' => function ($url,$model) {
                              $url =  $url;
                              return Html::a('<span class="btn btn-xs btn-info">Show </span>', $url, ['target' => '_blank']);
                            },
                          
                        ],
                    ],
                ],
            ]); ?>
        <?php Pjax::end(); ?>

        </div>

      </div>
    </div>
</div>      
