<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page" data-animsition-in="fade-in" data-animsition-out="fade-out">
    <div class="page-content">
      <div class="page-brand-info">
        <div class="brand">
          <img class="brand-img" src="<?=Url::base('')?>/admin-theme/iconbar/assets/images/logo@2x.png" alt="...">
          <h2 class="brand-text font-size-40">PNS ERP</h2>
        </div>
        <p class="font-size-20">Now cover product , supplier & customer modules</p>
      </div>
      <div class="page-login-main">
        <div class="brand hidden-md-up">
          <img class="brand-img" src="<?=Url::base('')?>/admin-theme/iconbar/assets/images/logo-blue@2x.png" alt="...">
          <h3 class="brand-text font-size-40">PNS ERP</h3>
        </div>
        <h3 class="font-size-24">Sign In</h3>
        <p>Please fill out the following fields to login</p>
        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

            <?= $form->field($model, 'email',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'password',['options' => ['class' => 'form-group form-material floating','data-plugin' => 'formMaterial']])->passwordInput() ?>

            

            <div class="form-group clearfix">
                <div class="checkbox-custom checkbox-inline checkbox-primary float-left">
                  <?= $form->field($model, 'rememberMe')->checkbox() ?>
                </div>
                <a style="float: right;margin-top: 15px;" class="float-right" href="#">Forgot password?</a>
            </div>

            <div class="form-group">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
            </div>

        <?php ActiveForm::end(); ?>        
       
        <footer class="page-copyright">
          <p>WEBSITE BY HalfWay</p>
          <p>© 2017. All RIGHT RESERVED.</p>
          <div class="social">
            <a class="btn btn-icon btn-round social-twitter" href="javascript:void(0)">
              <i class="icon bd-twitter" aria-hidden="true"></i>
            </a>
            <a class="btn btn-icon btn-round social-facebook" href="javascript:void(0)">
              <i class="icon bd-facebook" aria-hidden="true"></i>
            </a>
            <a class="btn btn-icon btn-round social-google-plus" href="javascript:void(0)">
              <i class="icon bd-google-plus" aria-hidden="true"></i>
            </a>
          </div>
        </footer>
      </div>
    </div>
  </div>

