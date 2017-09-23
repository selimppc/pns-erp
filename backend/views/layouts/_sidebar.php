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
                  <a class="animsition-link" href="<?= Url::toRoute(['/master-report']); ?>">
                    <span class="site-menu-title">Reports</span>
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
                  <a class="animsition-link" href="<?= Url::toRoute(['/purchase-order']); ?>">
                    <span class="site-menu-title">Purchase Order</span>
                  </a>
                </li> 
                <li class="site-menu-item">
                  <a class="animsition-link" href="<?= Url::toRoute(['/purchase-settings']); ?>">
                    <span class="site-menu-title">Settings</span>
                  </a>
                </li> 
                <li class="site-menu-item">
                  <a class="animsition-link" href="<?= Url::toRoute(['/purchase-report']); ?>">
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
                  <a class="animsition-link" href="<?= Url::toRoute(['/grn/grn-history']); ?>">
                    <span class="site-menu-title">GRN</span>
                  </a>
                </li>
                <li class="site-menu-item">
                  <a class="animsition-link" href="<?= Url::toRoute(['/stock-view']); ?>">
                    <span class="site-menu-title">Stock View</span>
                  </a>
                </li> 
                <li class="site-menu-item">
                  <a class="animsition-link" href="<?= Url::toRoute(['/stock-transfer']); ?>">
                    <span class="site-menu-title">Stock Transfer</span>
                  </a>
                </li> 
                <li class="site-menu-item">
                  <a class="animsition-link" href="#">
                    <span class="site-menu-title">Stock Receive</span>
                  </a>
                </li>
                <li class="site-menu-item">
                  <a class="animsition-link" href="<?= Url::toRoute(['/stock-adustment']); ?>">
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
                  <a class="animsition-link" href="<?= Url::toRoute(['/inventory-settings']); ?>">
                    <span class="site-menu-title">Settings</span>
                  </a>
                </li>
                <li class="site-menu-item">
                  <a class="animsition-link" href="<?= Url::toRoute(['/inventory-report']); ?>">
                    <span class="site-menu-title">Reports</span>
                  </a>
                </li>
              </ul>
            </li>

            <li class="site-menu-item has-sub">
              <a href="javascript:void(0)">
                <i class="site-menu-icon md-balance-wallet" aria-hidden="true"></i>
                <span class="site-menu-title">Account Payable</span>
              </a>
              <ul class="site-menu-sub">
                <li class="site-menu-item">
                  <a class="animsition-link" href="<?= Url::toRoute(['/account-payable-invoice']); ?>">
                    <span class="site-menu-title">Invoice</span>
                  </a>
                </li>
                <li class="site-menu-item">
                  <a class="animsition-link" href="#">
                    <span class="site-menu-title">Payment</span>
                  </a>
                </li> 
                <li class="site-menu-item">
                  <a class="animsition-link" href="#">
                    <span class="site-menu-title">Report</span>
                  </a>
                </li> 
                
              </ul>
            </li>

            <li class="site-menu-item has-sub">
              <a href="javascript:void(0)">
                <i class="site-menu-icon md-money-box" aria-hidden="true"></i>
                <span class="site-menu-title">Sales</span>
              </a>
              <ul class="site-menu-sub">
                <li class="site-menu-item">
                  <a class="animsition-link" href="<?= Url::toRoute(['/sales-invoice']); ?>">
                    <span class="site-menu-title">Invoice Entry</span>
                  </a>
                </li>
                <li class="site-menu-item">
                  <a class="animsition-link" href="<?= Url::toRoute(['/sales-invoice/direct-sales']); ?>">
                    <span class="site-menu-title">Direct Sales </span>
                  </a>
                </li> 
                <li class="site-menu-item">
                  <a class="animsition-link" href="#">
                    <span class="site-menu-title">Money Recipt</span>
                  </a>
                </li> 
                <li class="site-menu-item">
                  <a class="animsition-link" href="<?= Url::toRoute(['/sales-settings']); ?>">
                    <span class="site-menu-title">Settings</span>
                  </a>
                </li> 
                <li class="site-menu-item">
                  <a class="animsition-link" href="<?= Url::toRoute(['/sales-reports']); ?>">
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
                  <a class="animsition-link" href="#">
                    <span class="site-menu-title">Voucher</span>
                  </a>
                </li>
                <li class="site-menu-item">
                  <a class="animsition-link" href="#">
                    <span class="site-menu-title">Transaction</span>
                  </a>
                </li>
                <li class="site-menu-item">
                  <a class="animsition-link" href="<?= Url::toRoute(['/general-ledger-settings']); ?>">
                    <span class="site-menu-title">Settings</span>
                  </a>
                </li>  
                <li class="site-menu-item">
                  <a class="animsition-link" href="<?= Url::toRoute(['/general-ledger-report']); ?>">
                    <span class="site-menu-title">Reports</span>
                  </a>
                </li> 
              </ul>
            </li>

            <li class="site-menu-item">
              <a href="javascript:void(0)" class="logout">
                
                <span class="site-menu-title"><?= Html::beginForm(['/site/logout'], 'post'); ?>

                  <?= Html::submitButton(
                      '<i class="site-menu-icon md-power" aria-hidden="true"></i> Logout',

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