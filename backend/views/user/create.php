<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = Yii::t('app', 'Create User');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-content">
    <!-- Panel Basic -->
    <div class="panel">

    	<header class="panel-heading">
          <div class="panel-actions"><?= Html::encode($this->title) ?></div>
          <h3 class="panel-title">Basic</h3>
        </header>
     
	    <div class="panel-body">

	    	<?= $this->render('_form', [
			        'model' => $model,
			    ]) ?>

	    </div>

</div>
     
      	




