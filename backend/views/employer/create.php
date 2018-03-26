<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;


/* @var $this yii\web\View */
/* @var $model backend\models\SalesPerson */

$this->title = 'Create Employee';
$this->params['breadcrumbs'][] = ['label' => 'Empployer', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php Pjax::begin(); ?>

	<div class="page-header">

	      <ol class="breadcrumb">
	        <li class="breadcrumb-item"><a href="<?=Url::base('')?>">Home</a></li>
	        <li class="breadcrumb-item">Administrator</li>
	        <li class="breadcrumb-item"><a href="<?= Url::toRoute(['/employer']); ?>">Employees</a></li>
	        <li class="breadcrumb-item active"><?= Html::encode($this->title) ?></li>
	      </ol>     
	     
	      <div class="middle-menu-bar">
	        <?= Html::a(Yii::t('app', 'Add Employee'), ['create'], ['class' => '']) ?>
	        <?= Html::a(Yii::t('app', 'Manage Employees'), ['index'], ['class' => '']) ?>   
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
	              <?=\Yii::$app->params['employer_create']?>
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