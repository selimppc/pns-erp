<?php

use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = Yii::t('app', 'Create User');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-header">
      <h1 class="page-title"><?= Html::encode($this->title) ?></h1>

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=Url::base('')?>">Home</a></li>
        <li class="breadcrumb-item active">Users</li>
      </ol>
     
      <div class="page-header-actions">
        <?= Html::a(Yii::t('app', 'Create User'), ['create'], ['class' => 'btn btn-sm btn-primary btn-round']) ?>   
        <?= Html::a(Yii::t('app', 'Manage Users'), ['index'], ['class' => 'btn btn-sm btn-primary btn-round']) ?>   
        <?php
          echo \yii\helpers\Html::a( 'Back', Yii::$app->request->referrer,['class' => 'btn btn-sm btn-info btn-round waves-effect']);
        ?>    
      </div>
</div>

<div class="page-content">
    <!-- Panel Basic -->
    <div class="panel">
     
	    <div class="panel-body">

	    	<?= $this->render('_form', [
			        'model' => $model,
			    ]) ?>

	    </div>

</div>
     
      	




