<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model backend\models\Supplier */

$this->title = Yii::t('app', '{modelClass}: ', [
    'modelClass' => 'Supplier',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Suppliers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<?php Pjax::begin(); ?>

    <div class="page-header">
         

          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?=Url::base('')?>">Home</a></li>
            <li class="breadcrumb-item">Master Setup</li>
            <li class="breadcrumb-item"><a href="<?= Url::toRoute(['/supplier']); ?>">Supplier</a></li>
            <li class="breadcrumb-item active"><?= Html::encode($this->title) ?></li>
          </ol>
         
          <div class="middle-menu-bar">
            <?= Html::a(Yii::t('app', 'Create Suppliers'), ['create'], ['class' => '']) ?>   
            <?= Html::a(Yii::t('app', 'Manage Suppliers'), ['index'], ['class' => '']) ?>  

            <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                    'class' => '',
                    'data' => [
                        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ],
                ]) ?>
                 
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
                   <b> Update ::</b> <?= Html::encode($this->title) ?>
                </div>
            </div>

            <div class="panel-body">

            	<?= $this->render('_form', [
    		        'model' => $model,
    		    ]) ?>

            </div>

        </div>
    </div>

<?php Pjax::end(); ?>