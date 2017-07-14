<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'User',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>

<div class="page-content">
    <!-- Panel Basic -->
    <div class="panel">

    	<header class="panel-heading">
          <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
        </header>

        <div class="panel-body">

        	<?= $this->render('_form', [
		        'model' => $model,
		    ]) ?>

        </div>

    </div>
</div>
