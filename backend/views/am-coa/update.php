<?php
use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AmCoa */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Am Coa',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Am Coas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>

<div class="page-header">

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=Url::base('')?>">Home</a></li>
        <li class="breadcrumb-item active"><?= Html::encode($this->title) ?></li>
      </ol>     
     
      <div class="middle-menu-bar">
        <?= Html::a(Yii::t('app', 'Create Am Coa'), ['create'], ['class' => '']) ?>   
        <?= Html::a(Yii::t('app', 'Manage Am Coa'), ['index'], ['class' => '']) ?>   
        <?php
          echo \yii\helpers\Html::a( 'Back', Yii::$app->request->referrer,['class' => 'back']);
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

        	<?= $this->render('_form', [
		        'model' => $model,
		    ]) ?>

        </div>

    </div>

</div>