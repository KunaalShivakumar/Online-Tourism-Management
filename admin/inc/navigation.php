<style>
  .main-sidebar {
    background: #12252d !important;
  }
  .main-sidebar .brand-link {
    background: #0f766e !important;
    border-bottom: 1px solid rgba(255,255,255,.15);
  }
  .main-sidebar .brand-text,
  .main-sidebar .nav-sidebar .nav-link,
  .main-sidebar .nav-sidebar .nav-icon,
  .main-sidebar .nav-sidebar .nav-link p {
    color: rgba(255,255,255,.88) !important;
  }
  .main-sidebar .nav-sidebar .nav-link {
    margin-bottom: .25rem;
    border-radius: 8px;
  }
  .main-sidebar .nav-sidebar .nav-link:hover {
    background: rgba(255,255,255,.10);
  }
  .main-sidebar .nav-sidebar .nav-link.active {
    color: #fff !important;
    background: #0f766e !important;
    box-shadow: none;
  }
  .main-sidebar .nav-header {
    color: rgba(255,255,255,.55);
    font-size: .72rem;
    font-weight: 800;
    letter-spacing: .08em;
  }
</style>
<!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="<?php echo base_url ?>admin" class="brand-link bg-primary text-sm">
        <img src="<?php echo validate_image($_settings->info('logo'))?>" alt="Store Logo" class="brand-image img-circle elevation-3" style="opacity: .8;width: 2.5rem;height: 2.5rem;max-height: unset">
        <span class="brand-text font-weight-light"><?php echo $_settings->info('short_name') ?></span>
        </a>
        <!-- Sidebar -->
        <div class="sidebar os-host os-theme-light os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-transition os-host-scrollbar-horizontal-hidden">
          <div class="os-resize-observer-host observed">
            <div class="os-resize-observer" style="left: 0px; right: auto;"></div>
          </div>
          <div class="os-size-auto-observer observed" style="height: calc(100% + 1px); float: left;">
            <div class="os-resize-observer"></div>
          </div>
          <div class="os-content-glue" style="margin: 0px -8px; width: 249px; height: 646px;"></div>
          <div class="os-padding">
            <div class="os-viewport os-viewport-native-scrollbars-invisible" style="overflow-y: scroll;">
              <div class="os-content" style="padding: 0px 8px; height: 100%; width: 100%;">
                <!-- Sidebar user panel (optional) -->
                <div class="clearfix"></div>
                <!-- Sidebar Menu -->
                <nav class="mt-4">
                   <ul class="nav nav-pills nav-sidebar flex-column text-sm nav-compact nav-flat nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-header">MAIN</li>
                    <li class="nav-item dropdown">
                      <a href="./" class="nav-link nav-home">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                          Dashboard
                        </p>
                      </a>
                    </li> 
                    <li class="nav-header">OPERATIONS</li>
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=packages" class="nav-link nav-packages">
                        <i class="nav-icon fas fa-map-marked"></i>
                        <p>
                          Packages
                        </p>
                      </a>
                    </li>
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=books" class="nav-link nav-books">
                        <i class="nav-icon fas fa-th-list"></i>
                        <p>
                          Bookings
                        </p>
                      </a>
                    </li>
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=inquiries" class="nav-link nav-inquiries">
                        <i class="nav-icon fas fa-question-circle"></i>
                        <p>
                        Inquiries
                        </p>
                      </a>
                    </li>
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=responses" class="nav-link nav-responses">
                        <i class="nav-icon fas fa-reply"></i>
                        <p>
                          Responses
                        </p>
                      </a>
                    </li>
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=unanswered" class="nav-link nav-unanswered">
                        <i class="nav-icon fas fa-inbox"></i>
                        <p>
                          Unanswered
                        </p>
                      </a>
                    </li>
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=review" class="nav-link nav-review">
                        <i class="nav-icon fas fa-comment-alt"></i>
                        <p>
                        Rate & Reviews
                        </p>
                      </a>
                    </li>
                    <li class="nav-header">ADMIN</li>
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=user" class="nav-link nav-user">
                        <i class="nav-icon fas fa-users-cog"></i>
                        <p>
                          Users
                        </p>
                      </a>
                    </li>
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=system_info" class="nav-link nav-system_info">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                          Settings
                        </p>
                      </a>
                    </li>
                  </ul>
                </nav>
                <!-- /.sidebar-menu -->
              </div>
            </div>
          </div>
          <div class="os-scrollbar os-scrollbar-horizontal os-scrollbar-unusable os-scrollbar-auto-hidden">
            <div class="os-scrollbar-track">
              <div class="os-scrollbar-handle" style="width: 100%; transform: translate(0px, 0px);"></div>
            </div>
          </div>
          <div class="os-scrollbar os-scrollbar-vertical os-scrollbar-auto-hidden">
            <div class="os-scrollbar-track">
              <div class="os-scrollbar-handle" style="height: 55.017%; transform: translate(0px, 0px);"></div>
            </div>
          </div>
          <div class="os-scrollbar-corner"></div>
        </div>
        <!-- /.sidebar -->
      </aside>
      <script>
    $(document).ready(function(){
      var page = '<?php echo isset($_GET['page']) ? $_GET['page'] : 'home' ?>';
      var s = '<?php echo isset($_GET['s']) ? $_GET['s'] : '' ?>';
      page = page.split('/');
      page = page[0];
      if(s!='')
        page = page+'_'+s;

      if($('.nav-link.nav-'+page).length > 0){
             $('.nav-link.nav-'+page).addClass('active')
        if($('.nav-link.nav-'+page).hasClass('tree-item') == true){
            $('.nav-link.nav-'+page).closest('.nav-treeview').siblings('a').addClass('active')
          $('.nav-link.nav-'+page).closest('.nav-treeview').parent().addClass('menu-open')
        }
        if($('.nav-link.nav-'+page).hasClass('nav-is-tree') == true){
          $('.nav-link.nav-'+page).parent().addClass('menu-open')
        }

      }
     
    })
  </script>
