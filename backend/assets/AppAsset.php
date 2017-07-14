<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',

        'admin-theme/iconbar/assets/css/site.min.css',

        'admin-theme/global/css/bootstrap.min.css',
        'admin-theme/global/css/bootstrap-extend.min.css',

        'admin-theme/global/vendor/animsition/animsition.css',
        'admin-theme/global/vendor/asscrollable/asScrollable.css',
        'admin-theme/global/vendor/switchery/switchery.css',
        'admin-theme/global/vendor/intro-js/introjs.css',
        'admin-theme/global/vendor/slidepanel/slidePanel.css',
        'admin-theme/global/vendor/flag-icon-css/flag-icon.css',
        'admin-theme/global/vendor/waves/waves.css',
        'admin-theme/global/vendor/chartist/chartist.css',
        'admin-theme/global/vendor/jvectormap/jquery-jvectormap.css',
        'admin-theme/global/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css',

        'admin-theme/iconbar/assets/examples/css/dashboard/v1.css',

        'admin-theme/iconbar/assets/examples/css/pages/login-v2.css',

        'admin-theme/global/fonts/material-design/material-design.min.css',
        'admin-theme/global/fonts/brand-icons/brand-icons.min.css',

        'http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic',

    ];
    public $js = [

        'admin-theme/global/vendor/html5shiv/html5shiv.min.js',

        'admin-theme/global/vendor/media-match/media.match.min.js',
        'admin-theme/global/vendor/respond/respond.min.js',

        'admin-theme/global/vendor/breakpoints/breakpoints.js',

        'admin-theme/global/vendor/babel-external-helpers/babel-external-helpers.js',
        'admin-theme/global/vendor/tether/tether.js',
        'admin-theme/global/vendor/bootstrap/bootstrap.js',
        'admin-theme/global/vendor/animsition/animsition.js',
        'admin-theme/global/vendor/mousewheel/jquery.mousewheel.js',
        'admin-theme/global/vendor/asscrollbar/jquery-asScrollbar.js',
        'admin-theme/global/vendor/asscrollable/jquery-asScrollable.js',
        'admin-theme/global/vendor/ashoverscroll/jquery-asHoverScroll.js',

        'admin-theme/global/vendor/switchery/switchery.min.js',
        'admin-theme/global/vendor/intro-js/intro.js',
        'admin-theme/global/vendor/waves/waves.js',

        'admin-theme/global/vendor/screenfull/screenfull.js',
        'admin-theme/global/vendor/slidepanel/jquery-slidePanel.js',
        'admin-theme/global/vendor/chartist/chartist.min.js',
        'admin-theme/global/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.min.js',
        'admin-theme/global/vendor/jvectormap/jquery-jvectormap.min.js',
        'admin-theme/global/vendor/jvectormap/maps/jquery-jvectormap-world-mill-en.js',
        'admin-theme/global/vendor/matchheight/jquery.matchHeight-min.js',
        'admin-theme/global/vendor/peity/jquery.peity.min.js',
        'admin-theme/global/js/State.js',
        'admin-theme/global/js/Component.js',
        'admin-theme/global/js/Plugin.js',
        'admin-theme/global/js/Base.js',
        'admin-theme/global/js/Config.js',

        'admin-theme/iconbar/assets/js/Section/Menubar.js',
        'admin-theme/iconbar/assets/js/Section/Sidebar.js',
        'admin-theme/iconbar/assets/js/Section/PageAside.js',
        'admin-theme/iconbar/assets/js/Plugin/menu.js',

        'admin-theme/global/js/config/colors.js',
        'admin-theme/iconbar/assets/js/config/tour.js',
        'admin-theme/iconbar/assets/js/Site.js',

        'admin-theme/global/js/Plugin/asscrollable.js',
        'admin-theme/global/js/Plugin/slidepanel.js',
        'admin-theme/global/js/Plugin/switchery.js',
        'admin-theme/global/js/Plugin/matchheight.js',
        'admin-theme/global/js/Plugin/jvectormap.js',
        'admin-theme/global/js/Plugin/peity.js',

        'admin-theme/iconbar/assets/examples/js/dashboard/v1.js',

    ];
    public $depends = [
        'yii\web\YiiAsset',
       # 'yii\bootstrap\BootstrapAsset',
    ];
}
