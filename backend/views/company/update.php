<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model backend\models\Company */

$this->title = Yii::t('app', '{modelClass}', [
    'modelClass' => 'Company',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Companies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<?php Pjax::begin(); ?>
<div class="page-header">

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=Url::base('')?>">Home</a></li>
        <li class="breadcrumb-item active"><?= Html::encode($this->title) ?></li>
      </ol>     
     
      <div class="middle-menu-bar">
        <?= Html::a(Yii::t('app', 'Add New Company'), ['create'], ['class' => '']) ?>
        <?= Html::a(Yii::t('app', 'Manage Companies'), ['index'], ['class' => '']) ?>   
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
            <b>Update :: </b><?= Html::encode($this->title) ?>
        </div>
      </div>

     
	    <div class="panel-body">

	    	<?= $this->render('_form', [
			        'model' => $model,
			    ]) ?>

	    </div>

</div>
<?php Pjax::end(); ?>