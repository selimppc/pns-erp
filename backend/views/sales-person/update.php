<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model backend\models\SalesPerson */

$this->title = Yii::t('app', 'Update :: ', [
    'modelClass' => 'Sales Person',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sales Person'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>

<?php Pjax::begin(); ?>


	<div class="page-header">

	      <ol class="breadcrumb">
	        <li class="breadcrumb-item"><a href="<?=Url::base('')?>">Home</a></li>
	        <li class="breadcrumb-item">Master Setup</li>
	        <li class="breadcrumb-item"><a href="<?= Url::toRoute(['/sales-person']); ?>">Sales Person</a></li>
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
		          <b>View ::</b> <?= Html::encode($this->title) ?>
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
