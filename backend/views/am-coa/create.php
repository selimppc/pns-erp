<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model backend\models\AmCoa */

$this->title = Yii::t('app', 'Create Chart of Account');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Chart of Account'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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
                  if(isset(\Yii::$app->params['am_coa_create']) && !empty(\Yii::$app->params['am_coa_create'])){
                    echo \Yii::$app->params['am_coa_create'];
                  }
              ?>
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