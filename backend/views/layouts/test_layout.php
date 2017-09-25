<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

</head>
<body class="animsition dashboard">
<?php $this->beginBody() ?>

    
    <div class="site-menubar" style="display: none;">
    <div class="site-menubar-body">
      <div>
        <div>
          <ul class="site-menu" data-plugin="menu">

          </ul>
        </div>
      </div>
    </div>
    </div>      

    <!-- Page -->
    <div class="page" style="margin-left: 0;margin-top:-67px;">

        <?= $content ?>

    </div>
   

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
