<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model backend\models\SmHead */

$this->title = 'Update :: ' . $model->sm_number;
$this->params['breadcrumbs'][] = ['label' => 'Direct Sale', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="page-header">

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=Url::base('')?>">Home</a></li>
        <li class="breadcrumb-item">Sales</li>
        <li class="breadcrumb-item"><a href="<?= Url::toRoute(['/direct-sales']); ?>">Direct Sales</a></li>
        <li class="breadcrumb-item active"><?= Html::encode($this->title) ?></li>
      </ol>
     
      <div class="middle-menu-bar">
        <?= Html::a(Yii::t('app', 'Create Direct Sales'), ['create'], ['class' => '']) ?>   
        <?= Html::a(Yii::t('app', 'Manage Direct Sales'), ['index'], ['class' => '']) ?>   
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

	    	<?= $this->render('_form_direct_sale', [
		        'model' => $model
		    ]) ?>

	    </div>

    </div>

</div>    