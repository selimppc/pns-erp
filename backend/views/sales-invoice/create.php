<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;


/* @var $this yii\web\View */
/* @var $model backend\models\SmHead */

$this->title = 'Create Sales Invoice';
$this->params['breadcrumbs'][] = ['label' => 'Sm Heads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-header">

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=Url::base('')?>">Home</a></li>
        <li class="breadcrumb-item">Sales</li>

        <li class="breadcrumb-item active"><a href="<?= Url::toRoute(['/sales-invoice']); ?>"><?= Html::encode($this->title) ?></a></li>
      </ol>
     
      <div class="middle-menu-bar">
        <?= Html::a(Yii::t('app', 'Create '.$this->title), ['create'], ['class' => '']) ?>   
        <?= Html::a(Yii::t('app', 'Manage '.$this->title), ['index'], ['class' => '']) ?>   
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
                if(isset(\Yii::$app->params['invoice_entry_view']) && !empty(\Yii::$app->params['invoice_entry_view'])){
                  echo \Yii::$app->params['invoice_entry_view'];
                }
              ?>              
          </div>
      </div>

      <div class="panel-body">

	    	<?= $this->render('_form', [
		        'modelSmHead' => $modelSmHead,
		        'modelsSmDetail' => $modelsSmDetail
		    ]) ?>

	    </div>

    </div>
    
</div>      
