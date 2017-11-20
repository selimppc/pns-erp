<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

use yii\helpers\ArrayHelper;

use backend\models\CodesParam;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SalesPersonSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sales People';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php Pjax::begin(); ?>

    <div class="page-header">

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=Url::base('')?>">Home</a></li>
        <li class="breadcrumb-item">Administrator</li>        
        <li class="breadcrumb-item active"><?= Html::encode($this->title) ?></li>
      </ol>
     
      <div class="middle-menu-bar">
        <?= Html::a(Yii::t('app', 'Add New Sales Person'), ['create'], ['class' => '']) ?>
        <?= Html::a(Yii::t('app', 'Manage Sales Person'), ['index'], ['class' => '']) ?>   
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
              <?=\Yii::$app->params['sales_person_index']?>
              
          </div>
        </div>

        <div class="panel-body">

          <div class="table-responsive">

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        #['class' => 'yii\grid\SerialColumn'],

                        'id',
                        'sales_person_code',
                        'name',
                        'address:ntext',
                        // 'terotorry',
                        // 'type',
                         'cell',
                         'phone',
                         'fax',
                         'email:email',
                        // 'branch_id',
                        // 'market',
                        // 'credit_limit',
                        // 'hub',
                        [
                            'attribute' => 'status',
                            'label' => 'Status',
                            'filter'=>array("active"=>"Active","inactive"=>"Inactive","cancel"=>"Cancel"),
                            'value' => function ($model){
                                return ucfirst($model->status);
                            }
                        ],
                        // 'created_by',
                        // 'updated_by',
                        // 'created_at',
                        // 'updated_at',

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

          </div>

        </div>  

    </div>

</div>    


<?php Pjax::end(); ?>

