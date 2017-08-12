<?php
  use yii\helpers\Url;
  use yii\helpers\Html;
?>
<nav class="site-navbar navbar navbar-default navbar-inverse navbar-fixed-top navbar-mega"
  role="navigation">
    <div class="navbar-header">
      <button type="button" class="navbar-toggler hamburger hamburger-close navbar-toggler-left hided"
      data-toggle="menubar">
        <span class="sr-only">Toggle navigation</span>
        <span class="hamburger-bar"></span>
      </button>
      <button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-collapse"
      data-toggle="collapse">
        <i class="icon md-more" aria-hidden="true"></i>
      </button>
      <div class="navbar-brand navbar-brand-center site-gridmenu-toggle" data-toggle="gridmenu">
        <a href="<?=Url::base('')?>">
          <img class="navbar-brand-logo" src="<?=Url::base('')?>/admin-theme/iconbar/assets/images/logo@2x.png" title="Remark">
          <span class="navbar-brand-text hidden-xs-down"> ERP</span>
        </a>
      </div>
      <button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-search"
      data-toggle="collapse">
        <span class="sr-only">Toggle Search</span>
        <i class="icon md-search" aria-hidden="true"></i>
      </button>
    </div>
    <div class="navbar-container container-fluid">
      <!-- Navbar Collapse -->
      <div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
        <!-- Navbar Toolbar -->
        <ul class="nav navbar-toolbar">
          <li class="nav-item hidden-float" id="toggleMenubar">
            <a class="nav-link" data-toggle="menubar" href="#" role="button">
              <i class="icon hamburger hamburger-arrow-left">
                  <span class="sr-only">Toggle menubar</span>
                  <span class="hamburger-bar"></span>
                </i>
            </a>
          </li>
          <li class="nav-item hidden-sm-down" id="toggleFullscreen">
            <a class="nav-link icon icon-fullscreen" data-toggle="fullscreen" href="#" role="button">
              <span class="sr-only">Toggle fullscreen</span>
            </a>
          </li>
          <li class="nav-item hidden-float">
            <a class="nav-link icon md-search" data-toggle="collapse" href="#" data-target="#site-navbar-search"
            role="button">
              <span class="sr-only">Toggle Search</span>
            </a>
          </li>
          <li class="nav-item dropdown dropdown-fw dropdown-mega">
            <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false" data-animation="fade"
            role="button">HW Menu <i class="icon md-chevron-down" aria-hidden="true"></i></a>
            <div class="dropdown-menu" role="menu">
              <div class="mega-content">
                <div class="row">
                  <div class="col-md-2">
                    <h5>Administration</h5>
                    <ul class="blocks-2">
                      <li class="mega-menu m-0">
                        <ul class="list-icons">
                          <li><i class="md-chevron-right" aria-hidden="true"></i>
                            <a href="#" >Company Profile</a>
                          </li>
                          <li><i class="md-chevron-right" aria-hidden="true"></i>
                            <a href="#">Roles</a>
                          </li>
                          <li><i class="md-chevron-right" aria-hidden="true"></i>
                            <a href="<?= Url::toRoute(['/user']); ?>">User</a>
                          </li>
                       
                        </ul>
                      </li>
                     
                    </ul>
                  </div>

                  <div class="col-md-2">
                    <h5>Master Setup</h5>
                    <ul class="blocks-2">
                      <li class="mega-menu m-0">
                        <ul class="list-icons">
                          <li><i class="md-chevron-right" aria-hidden="true"></i>
                            <a href="<?= Url::toRoute(['/product']); ?>" >Product Master</a>
                          </li>
                          <li><i class="md-chevron-right" aria-hidden="true"></i>
                            <a href="#">Service Master</a>
                          </li>
                          <li><i class="md-chevron-right" aria-hidden="true"></i>
                            <a href="<?= Url::toRoute(['/supplier']); ?>">Supplier Master</a>
                          </li>
                           <li><i class="md-chevron-right" aria-hidden="true"></i>
                            <a href="<?= Url::toRoute(['/customer']); ?>">Customer Master</a>
                          </li>
                          <li><i class="md-chevron-right" aria-hidden="true"></i>
                            <a href="<?= Url::toRoute(['/branch']); ?>">Branch Master</a>
                          </li>
                          <li><i class="md-chevron-right" aria-hidden="true"></i>
                            <a href="<?= Url::toRoute(['/currency']); ?>">Currency Master</a>
                          </li>
                          <li><i class="md-chevron-right" aria-hidden="true"></i>
                            <a href="<?= Url::toRoute(['/settings']); ?>">Settings</a>
                          </li>
                          <li><i class="md-chevron-right" aria-hidden="true"></i>
                            <a href="<?= Url::toRoute(['/master-report']); ?>">Reports</a>
                          </li>
                       
                        </ul>
                      </li>
                     
                    </ul>
                  </div>

                  <div class="col-md-2">
                    <h5>General Ledger</h5>
                    <ul class="blocks-1">
                      <li class="mega-menu m-0">
                        <ul class="list-icons">
                          <li><i class="md-chevron-right" aria-hidden="true"></i>
                            <a href="<?= Url::toRoute(['/am-coa']); ?>" >Chart of Accounts</a>
                          </li>
                       
                        </ul>
                      </li>
                     
                    </ul>
                  </div>

                  <div class="col-md-2">
                    <h5>Purchase</h5>
                    <ul class="blocks-1">
                      <li class="mega-menu m-0">
                        <ul class="list-icons">
                          <li><i class="md-chevron-right" aria-hidden="true"></i>
                            <a href="#" >Requisition</a>
                          </li>
                          <li><i class="md-chevron-right" aria-hidden="true"></i>
                            <a href="#">Purchase Order</a>
                          </li>
                          <li><i class="md-chevron-right" aria-hidden="true"></i>
                            <a href="#">Settings</a>
                          </li>
                          <li><i class="md-chevron-right" aria-hidden="true"></i>
                            <a href="#">Reports</a>
                          </li>
                       
                        </ul>
                      </li>
                     
                    </ul>
                  </div>

                  <div class="col-md-2">
                    <h5>Inventory</h5>
                    <ul class="blocks-2">
                      <li class="mega-menu m-0">
                        <ul class="list-icons">
                          <li><i class="md-chevron-right" aria-hidden="true"></i>
                            <a href="#" >GRN</a>
                          </li>
                          <li><i class="md-chevron-right" aria-hidden="true"></i>
                            <a href="#">Stock View</a>
                          </li>
                          <li><i class="md-chevron-right" aria-hidden="true"></i>
                            <a href="#">Stock Transfer</a>
                          </li>
                          <li><i class="md-chevron-right" aria-hidden="true"></i>
                            <a href="#">Stock Receive</a>
                          </li>
                          <li><i class="md-chevron-right" aria-hidden="true"></i>
                            <a href="#">Stock Adjustment</a>
                          </li>
                          <li><i class="md-chevron-right" aria-hidden="true"></i>
                            <a href="#">Delivery Order</a>
                          </li>
                          <li><i class="md-chevron-right" aria-hidden="true"></i>
                            <a href="#">IM to GL Interface</a>
                          </li>
                          <li><i class="md-chevron-right" aria-hidden="true"></i>
                            <a href="#">Settings</a>
                          </li>
                          <li><i class="md-chevron-right" aria-hidden="true"></i>
                            <a href="#">Reports</a>
                          </li>
                       
                        </ul>
                      </li>
                     
                    </ul>
                  </div>


                
                </div>
              </div>
            </div>
          </li>
        </ul>
        <!-- End Navbar Toolbar -->
        <!-- Navbar Toolbar Right -->
        <ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">

         
          <li class="nav-item dropdown">
            <a style="width: 75px;padding: 10px 0 0 0;" class="nav-link navbar-avatar" data-toggle="dropdown" href="<?=Url::base('')?>" aria-expanded="false"
            data-animation="scale-up" role="button">
              <span class="avatar avatar-online" style="width:50px;margin-top:-5px;">
                <img src="<?=Url::base('')?>/admin-theme/global/portraits/logo_pns_group.png" alt="...">
                
              </span>
              <span style="width: 100%;display: inline-block;  text-transform: uppercase;letter-spacing: 2px;
    font-size: 12px;">Admin</span>
            </a>
            <div class="dropdown-menu" role="menu">
              <a class="dropdown-item" href="javascript:void(0)" role="menuitem"><i class="icon md-account" aria-hidden="true"></i> Profile</a>
              <a class="dropdown-item" href="javascript:void(0)" role="menuitem"><i class="icon md-card" aria-hidden="true"></i> Billing</a>
              <a class="dropdown-item" href="javascript:void(0)" role="menuitem"><i class="icon md-settings" aria-hidden="true"></i> Settings</a>
              <div class="dropdown-divider"></div>
             
              <?= Html::beginForm(['/site/logout'], 'post'); ?>
              <?= Html::submitButton(
                  'Logout',
                  ['class' => 'dropdown-item waves-effect waves-light waves-round logout']
              ); ?>
              
              <?= Html::endForm(); ?>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="javascript:void(0)" title="Notifications"
            aria-expanded="false" data-animation="scale-up" role="button">
              <i class="icon md-notifications" aria-hidden="true"></i>
              <span class="badge badge-pill badge-danger up">5</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-media" role="menu">
              <div class="dropdown-menu-header">
                <h5>NOTIFICATIONS</h5>
                <span class="badge badge-round badge-danger">New 5</span>
              </div>
              <div class="list-group">
                <div data-role="container">
                  <div data-role="content">
                    <a class="list-group-item dropdown-item" href="javascript:void(0)" role="menuitem">
                      <div class="media">
                        <div class="pr-10">
                          <i class="icon md-receipt bg-red-600 white icon-circle" aria-hidden="true"></i>
                        </div>
                        <div class="media-body">
                          <h6 class="media-heading">A new order has been placed</h6>
                          <time class="media-meta" datetime="2017-06-12T20:50:48+08:00">5 hours ago</time>
                        </div>
                      </div>
                    </a>
                    <a class="list-group-item dropdown-item" href="javascript:void(0)" role="menuitem">
                      <div class="media">
                        <div class="pr-10">
                          <i class="icon md-account bg-green-600 white icon-circle" aria-hidden="true"></i>
                        </div>
                        <div class="media-body">
                          <h6 class="media-heading">Completed the task</h6>
                          <time class="media-meta" datetime="2017-06-11T18:29:20+08:00">2 days ago</time>
                        </div>
                      </div>
                    </a>
                    <a class="list-group-item dropdown-item" href="javascript:void(0)" role="menuitem">
                      <div class="media">
                        <div class="pr-10">
                          <i class="icon md-settings bg-red-600 white icon-circle" aria-hidden="true"></i>
                        </div>
                        <div class="media-body">
                          <h6 class="media-heading">Settings updated</h6>
                          <time class="media-meta" datetime="2017-06-11T14:05:00+08:00">2 days ago</time>
                        </div>
                      </div>
                    </a>
                    <a class="list-group-item dropdown-item" href="javascript:void(0)" role="menuitem">
                      <div class="media">
                        <div class="pr-10">
                          <i class="icon md-calendar bg-blue-600 white icon-circle" aria-hidden="true"></i>
                        </div>
                        <div class="media-body">
                          <h6 class="media-heading">Event started</h6>
                          <time class="media-meta" datetime="2017-06-10T13:50:18+08:00">3 days ago</time>
                        </div>
                      </div>
                    </a>
                    <a class="list-group-item dropdown-item" href="javascript:void(0)" role="menuitem">
                      <div class="media">
                        <div class="pr-10">
                          <i class="icon md-comment bg-orange-600 white icon-circle" aria-hidden="true"></i>
                        </div>
                        <div class="media-body">
                          <h6 class="media-heading">Message received</h6>
                          <time class="media-meta" datetime="2017-06-10T12:34:48+08:00">3 days ago</time>
                        </div>
                      </div>
                    </a>
                  </div>
                </div>
              </div>
              <div class="dropdown-menu-footer">
                <a class="dropdown-menu-footer-btn" href="javascript:void(0)" role="button">
                  <i class="icon md-settings" aria-hidden="true"></i>
                </a>
                <a class="dropdown-item" href="javascript:void(0)" role="menuitem">
                    All notifications
                  </a>
              </div>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="javascript:void(0)" title="Messages"
            aria-expanded="false" data-animation="scale-up" role="button">
              <i class="icon md-email" aria-hidden="true"></i>
              <span class="badge badge-pill badge-info up">3</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-media" role="menu">
              <div class="dropdown-menu-header" role="presentation">
                <h5>MESSAGES</h5>
                <span class="badge badge-round badge-info">New 3</span>
              </div>
              <div class="list-group" role="presentation">
                <div data-role="container">
                  <div data-role="content">
                    <a class="list-group-item dropdown-item" href="javascript:void(0)" role="menuitem">
                      <div class="media">
                        <div class="pr-10">
                          <span class="avatar avatar-sm avatar-online">
                            <img src="<?=Url::base('')?>/admin-theme/global/portraits/2.jpg" alt="..." />
                            <i></i>
                          </span>
                        </div>
                        <div class="media-body">
                          <h6 class="media-heading">Mary Adams</h6>
                          <div class="media-meta">
                            <time datetime="2017-06-17T20:22:05+08:00">30 minutes ago</time>
                          </div>
                          <div class="media-detail">Anyways, i would like just do it</div>
                        </div>
                      </div>
                    </a>
                    <a class="list-group-item dropdown-item" href="javascript:void(0)" role="menuitem">
                      <div class="media">
                        <div class="pr-10">
                          <span class="avatar avatar-sm avatar-off">
                            <img src="<?=Url::base('')?>/admin-theme/global/portraits/3.jpg" alt="..." />
                            <i></i>
                          </span>
                        </div>
                        <div class="media-body">
                          <h6 class="media-heading">Caleb Richards</h6>
                          <div class="media-meta">
                            <time datetime="2017-06-17T12:30:30+08:00">12 hours ago</time>
                          </div>
                          <div class="media-detail">I checheck the document. But there seems</div>
                        </div>
                      </div>
                    </a>
                    <a class="list-group-item dropdown-item" href="javascript:void(0)" role="menuitem">
                      <div class="media">
                        <div class="pr-10">
                          <span class="avatar avatar-sm avatar-busy">
                            <img src="<?=Url::base('')?>/admin-theme/global/portraits/4.jpg" alt="..." />
                            <i></i>
                          </span>
                        </div>
                        <div class="media-body">
                          <h6 class="media-heading">June Lane</h6>
                          <div class="media-meta">
                            <time datetime="2017-06-16T18:38:40+08:00">2 days ago</time>
                          </div>
                          <div class="media-detail">Lorem ipsum Id consectetur et minim</div>
                        </div>
                      </div>
                    </a>
                    <a class="list-group-item dropdown-item" href="javascript:void(0)" role="menuitem">
                      <div class="media">
                        <div class="pr-10">
                          <span class="avatar avatar-sm avatar-away">
                            <img src="<?=Url::base('')?>/admin-theme/global/portraits/5.jpg" alt="..." />
                            <i></i>
                          </span>
                        </div>
                        <div class="media-body">
                          <h6 class="media-heading">Edward Fletcher</h6>
                          <div class="media-meta">
                            <time datetime="2017-06-15T20:34:48+08:00">3 days ago</time>
                          </div>
                          <div class="media-detail">Dolor et irure cupidatat commodo nostrud nostrud.</div>
                        </div>
                      </div>
                    </a>
                  </div>
                </div>
              </div>
              <div class="dropdown-menu-footer" role="presentation">
                <a class="dropdown-menu-footer-btn" href="javascript:void(0)" role="button">
                  <i class="icon md-settings" aria-hidden="true"></i>
                </a>
                <a class="dropdown-item" href="javascript:void(0)" role="menuitem">
                    See all messages
                  </a>
              </div>
            </div>
          </li>
         
        </ul>
        <!-- End Navbar Toolbar Right -->
      </div>
      <!-- End Navbar Collapse -->
      <!-- Site Navbar Seach -->
      <div class="collapse navbar-search-overlap" id="site-navbar-search">
        <form role="search">
          <div class="form-group">
            <div class="input-search">
              <i class="input-search-icon md-search" aria-hidden="true"></i>
              <input type="text" class="form-control" name="site-search" placeholder="Search...">
              <button type="button" class="input-search-close icon md-close" data-target="#site-navbar-search"
              data-toggle="collapse" aria-label="Close"></button>
            </div>
          </div>
        </form>
      </div>
      <!-- End Site Navbar Seach -->
    </div>
  </nav>