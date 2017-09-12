<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\widgets\Pjax;


/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = Yii::t('app', 'Change Password');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', '<?= Html::encode($this->title) ?>'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php Pjax::begin(); ?>

<div class="form-two-column">

	<div class="page-header">

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=Url::base('')?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?=Url::toRoute(['/user'])?>">User</a></li>
        <li class="breadcrumb-item active"><?= Html::encode($this->title) ?></li>
      </ol>     
     
      <div class="middle-menu-bar">
        <?= Html::a(Yii::t('app', 'Add New User'), ['create'], ['class' => '']) ?>
        <?= Html::a(Yii::t('app', 'Manage Users'), ['index'], ['class' => '']) ?>   
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

	        <div class="panel-body">

	        	<?php $form = ActiveForm::begin(); ?>

	        		<div class="row">

	        			<div class="col-md-9">

	        				<?= $form->field($model, 'current_password',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->passwordInput(['maxlength' => true]) ?>

	        				<?= $form->field($model, 'new_password',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->passwordInput(['maxlength' => true]) ?>

	        				<?= $form->field($model, 'repeat_password',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->passwordInput(['maxlength' => true]) ?>

	        			</div>

	        		</div>	

	        		<?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Save Changes') : Yii::t('app', 'Save Changes'), ['class' => $model->isNewRecord ? 'btn btn-primary waves-effect pull-right' : 'btn btn-primary waves-effect pull-right']) ?>

	        	<?php $form = ActiveForm::end(); ?>

	        </div>

	    </div>



	</div>


</div>

<?php Pjax::end(); ?>