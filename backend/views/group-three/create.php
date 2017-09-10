<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;


/* @var $this yii\web\View */
/* @var $model backend\models\GroupThree */

$this->title = Yii::t('app', 'Create Group Three');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Group Threes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php Pjax::begin(); ?> 
<div class="page-header">

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=Url::base('')?>">Home</a></li>

        <li class="breadcrumb-item"><a>Master Setup</a></li>

        <li class="breadcrumb-item"><a href="<?= Url::toRoute(['/settings']); ?>">Settings</a></li>

        <li class="breadcrumb-item"><a>Group Master</a></li>

        <li class="breadcrumb-item active"><?= Html::encode($this->title) ?></li>
      </ol>     
     
      <div class="middle-menu-bar">
        <?= Html::a(Yii::t('app', 'Add New GroupThree'), ['create'], ['class' => '']) ?>
        <?= Html::a(Yii::t('app', 'Manage GroupThree'), ['index'], ['class' => '']) ?>   
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
                    if(isset(\Yii::$app->params['group_three_create']) && !empty(\Yii::$app->params['group_three_create'])){
                      echo \Yii::$app->params['group_three_create'];
                    }
                ?>
            </div>
        </div>
     
	    <div class="panel-body">

	    	<?= $this->render('_form', [
			        'model' => $model,
              'group_two_data' => $group_two_data
			    ]) ?>

	    </div>

</div>
<?php Pjax::end(); ?>