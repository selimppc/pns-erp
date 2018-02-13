<?php
	use yii\helpers\Url;
	use yii\helpers\Html;

	$this->title = Yii::t('app', 'Money Recipt');
	$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-header">

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=Url::base('')?>">Home</a></li>
        <li class="breadcrumb-item active"><?=$this->title?></li>
      </ol>
     
      <div class="middle-menu-bar">

        <?= Html::a(Yii::t('app', 'Manage '.$this->title), ['index'], ['class' => '']) ?>   
        
        <?php
          echo \yii\helpers\Html::a( '<i class="icon md-arrow-left" aria-hidden="true"></i> Back', Yii::$app->request->referrer,['class' => 'back']);
        ?>    
      </div>
</div>

<div class="page-content">
    <!-- Panel Basic -->
    <div class="panel">

    	<?php 
            if(Yii::$app->session->hasFlash('success')){
        ?>
            <div class="alert alert-success">
              <?= Yii::$app->session->getFlash('success'); ?>
            </div>
        <?php 
            }
        ?>

        <?php 
            if(Yii::$app->session->hasFlash('error')){
        ?>
            <div class="alert alert-danger">
              <?= Yii::$app->session->getFlash('error'); ?>
            </div>
        <?php 
            }
        ?>


        <div id="flag_desc">
            <div id="flag_desc_text">
              <?php
                if(isset(\Yii::$app->params['manage_recipt_index']) && !empty(\Yii::$app->params['manage_recipt_index'])){
                  echo \Yii::$app->params['manage_recipt_index'];
                }
              ?>              
            </div>
        </div>

        <div class="panel-body">

        	<div class="table-responsive">

        	</div>

        </div>	


    </div>
</div>    