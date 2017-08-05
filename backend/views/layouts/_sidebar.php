 <?php
 	use yii\helpers\Url;
  use yii\helpers\Html;
 ?>
 <div class="site-menubar">
    <div class="site-menubar-body">
      <div>
        <div>
          <ul class="site-menu" data-plugin="menu">
            <!-- <li class="site-menu-item active">
              <a class="animsition-link" href="<?=Url::base('')?>">
                <i class="site-menu-icon md-view-dashboard" aria-hidden="true"></i>
                <span class="site-menu-title">Dashboard</span>
              </a>
            </li> -->
            <li class="site-menu-item has-sub">
              <a href="javascript:void(0)">
                <i class="site-menu-icon md-account" aria-hidden="true"></i>
                <span class="site-menu-title">Administration</span>
              </a>
              <ul class="site-menu-sub">
                <li class="site-menu-item">
                  <a class="animsition-link" href="<?= Url::toRoute(['/company']); ?>">
                    <span class="site-menu-title">Company Profile</span>
                  </a>
                </li>
                <li class="site-menu-item">
                  <a class="animsition-link" href="<?= Url::toRoute(['/rbac/role']); ?>">
                    <span class="site-menu-title">Roles</span>
                  </a>
                </li>   
                <li class="site-menu-item">
                  <a class="animsition-link" href="<?= Url::toRoute(['/user']); ?>">
                    <span class="site-menu-title">User</span>
                  </a>
                </li>              
                
                
              </ul>
            </li>
            
            <li class="site-menu-item has-sub">
              <a href="javascript:void(0)">
                <i class="site-menu-icon md-settings" aria-hidden="true"></i>
                <span class="site-menu-title">Master Setup</span>
              </a>
              <ul class="site-menu-sub">
                <li class="site-menu-item">
                  <a class="animsition-link" href="<?= Url::toRoute(['/product']); ?>">
                    <span class="site-menu-title">Product Master</span>
                  </a>
                </li>    
                <li class="site-menu-item">
                  <a class="animsition-link" href="<?= Url::toRoute(['/supplier']); ?>">
                    <span class="site-menu-title">Supplier Master</span>
                  </a>
                </li>  

                <li class="site-menu-item">
                  <a class="animsition-link" href="<?= Url::toRoute(['/customer']); ?>">
                    <span class="site-menu-title">Customer Master</span>
                  </a>
                </li>  

                <li class="site-menu-item">
                  <a class="animsition-link" href="<?= Url::toRoute(['/branch']); ?>">
                    <span class="site-menu-title">Branch Master</span>
                  </a>
                </li>  

                <li class="site-menu-item">
                  <a class="animsition-link" href="<?= Url::toRoute(['/currency']); ?>">
                    <span class="site-menu-title">Currency Master</span>
                  </a>
                </li>  

                <li class="site-menu-item">
                  <a class="animsition-link" href="<?= Url::toRoute(['/settings']); ?>">
                    <span class="site-menu-title">Settings</span>
                  </a>
                </li>  
                <li class="site-menu-item">
                  <a class="animsition-link" href="#">
                    <span class="site-menu-title">Reports</span>
                  </a>
                </li>             
                
                
              </ul>
            </li>

            <li class="site-menu-item has-sub">
              <a href="javascript:void(0)">
                <i class="site-menu-icon md-border-all" aria-hidden="true"></i>
                <span class="site-menu-title">General Ledger</span>
              </a>
              <ul class="site-menu-sub">
                <li class="site-menu-item">
                  <a class="animsition-link" href="<?= Url::toRoute(['/am-coa']); ?>">
                    <span class="site-menu-title">Chart of Accounts</span>
                  </a>
                </li>
                <li class="site-menu-item">
                  <a class="animsition-link" href="<?= Url::toRoute(['/am-voucher-detail']); ?>">
                    <span class="site-menu-title">Voucher</span>
                  </a>
                </li>
                <li class="site-menu-item">
                  <a class="animsition-link" href="<?= Url::toRoute(['/im-transaction']); ?>">
                    <span class="site-menu-title">Transaction</span>
                  </a>
                </li>
              </ul>
            </li>

             <li class="site-menu-item has-sub">
              <a href="javascript:void(0)">
                <i class="site-menu-icon md-shopping-cart" aria-hidden="true"></i>
                <span class="site-menu-title">Purchase</span>
              </a>
              <ul class="site-menu-sub">
                
                <li class="site-menu-item">
                  <a class="animsition-link" href="<?= Url::toRoute(['/pp-purchase-head']); ?>">
                    <span class="site-menu-title">Purchase Order</span>
                  </a>
                </li> 
                <li class="site-menu-item">
                  <a class="animsition-link" href="#">
                    <span class="site-menu-title">Settings</span>
                  </a>
                </li> 
                <li class="site-menu-item">
                  <a class="animsition-link" href="#">
                    <span class="site-menu-title">Reports</span>
                  </a>
                </li>
              </ul>
            </li>

            <li class="site-menu-item has-sub">
              <a href="javascript:void(0)">
                <i class="site-menu-icon md-sort-amount-asc" aria-hidden="true"></i>
                <span class="site-menu-title">Inventory</span>
              </a>
              <ul class="site-menu-sub">
                <li class="site-menu-item">
                  <a class="animsition-link" href="<?= Url::toRoute(['/im-grn-head']); ?>">
                    <span class="site-menu-title">GRN</span>
                  </a>
                </li>
                <li class="site-menu-item">
                  <a class="animsition-link" href="#">
                    <span class="site-menu-title">Stock View</span>
                  </a>
                </li> 
                <li class="site-menu-item">
                  <a class="animsition-link" href="<?= Url::toRoute(['/im-transfer-head']); ?>">
                    <span class="site-menu-title">Stock Transfer</span>
                  </a>
                </li> 
                <li class="site-menu-item">
                  <a class="animsition-link" href="#">
                    <span class="site-menu-title">Stock Receive</span>
                  </a>
                </li>
                <li class="site-menu-item">
                  <a class="animsition-link" href="<?= Url::toRoute(['/im-adjust-detail']); ?>">
                    <span class="site-menu-title">Stock Adjustment</span>
                  </a>
                </li>
                <li class="site-menu-item">
                  <a class="animsition-link" href="#">
                    <span class="site-menu-title">Delivery Order</span>
                  </a>
                </li>
                <li class="site-menu-item">
                  <a class="animsition-link" href="<?= Url::toRoute(['/it-im-gl']); ?>">
                    <span class="site-menu-title">IM to GL Interface</span>
                  </a>
                </li>
                <li class="site-menu-item">
                  <a class="animsition-link" href="#">
                    <span class="site-menu-title">Settings</span>
                  </a>
                </li>
                <li class="site-menu-item">
                  <a class="animsition-link" href="#">
                    <span class="site-menu-title">Reports</span>
                  </a>
                </li>
              </ul>
            </li>

            <li class="site-menu-item has-sub">
              <a href="javascript:void(0)">
                <i class="site-menu-icon md-power" aria-hidden="true"></i>
                <span class="site-menu-title"><?= Html::beginForm(['/site/logout'], 'post'); ?>
              <?= Html::submitButton(
                  'Logout',

                  ['class' => 'dropdown-item waves-effect waves-light waves-round logout',
                  ]
              ); ?>
              
              <?= Html::endForm(); ?>
                
              </span>
              </a>
            </li>

          </ul>
        </div>
      </div>
    </div>
  </div>