<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model backend\models\AmCoa */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Chart of Account',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Chart of Account'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<?php Pjax::begin(); ?> 
<div class="page-header">

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=Url::base('')?>">Home</a></li>
        <li class="breadcrumb-item">General Ledger</li>
        <li class="breadcrumb-item active"><?= Html::encode($this->title) ?></li>
      </ol>     
     
      <div class="middle-menu-bar">
        <?= Html::a(Yii::t('app', 'Add New Chart of Account'), ['create'], ['class' => '']) ?>
        <?= Html::a(Yii::t('app', 'Manage Chart of Account'), ['index'], ['class' => '']) ?>   
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
<?php Pjax::end(); ?>