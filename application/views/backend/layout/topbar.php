<!-- BEGIN HEADER -->
<div class="header navbar navbar-inverse ">
  <!-- BEGIN TOP NAVIGATION BAR -->
  <div class="navbar-inner">
    <div class="header-seperation">
      <ul class="nav pull-left notifcation-center visible-xs visible-sm">
        <li class="dropdown">
          <a href="#main-menu" data-webarch="toggle-left-side">
            <i class="material-icons">menu</i>
          </a>
        </li>
      </ul>
      <!-- BEGIN LOGO -->
      <a href="<?= base_url('') ?>">
        <img src="<?= base_url('assets/') ?>img/" class="logo" alt="" data-src="<?= base_url('assets/') ?>img/" data-src-retina="<?= base_url('assets/') ?>img/" width="206" />
      </a>
      <!-- END LOGO -->
      <ul class="nav pull-right notifcation-center">
        <li class="dropdown hidden-xs hidden-sm">
          <a href="<?= base_url('') ?>" class="dropdown-toggle active" data-toggle="">
            <i class="fa fa-home"></i>
          </a>
        </li>
      </ul>
    </div>
    <!-- END RESPONSIVE MENU TOGGLER -->
    <div class="header-quick-nav">
      <!-- BEGIN TOP NAVIGATION MENU -->
      <div class="pull-left">
        <ul class="nav quick-section">
          <li class="quicklinks">
            <a href="#" class="" id="layout-condensed-toggle">
              <i class="fa fa-list" ></i>
            </a>
          </li>
        </ul>
      </div>
      <div id="notification-list" style="display:none">
        <div style="width:300px">
          <div class="notification-messages info">
            <div class="user-profile">
              <img src="<?=resize_image(69, $user['image'])?>" alt="" data-src="<?=resize_image(69, $user['image'])?>" data-src-retina="<?=resize_image(69, $user['image'])?>" width="35" height="35">
            </div>
            <div class="message-wrapper">
              <div class="heading">
                David Nester - Commented on your wall
              </div>
              <div class="description">
                Meeting postponed to tomorrow
              </div>
              <div class="date pull-left">
                A min ago
              </div>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="notification-messages danger">
            <div class="iconholder">
              <i class="icon-warning-sign"></i>
            </div>
            <div class="message-wrapper">
              <div class="heading">
                Server load limited
              </div>
              <div class="description">
                Database server has reached its daily capicity
              </div>
              <div class="date pull-left">
                2 mins ago
              </div>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="notification-messages success">
            <div class="user-profile">
              <img src="<?=resize_image(69, $user['image'])?>g" alt="" data-src="<?=resize_image(69, $user['image'])?>" data-src-retina="<?=resize_image(69, $user['image'])?>" width="35" height="35">
            </div>
            <div class="message-wrapper">
              <div class="heading">
                You haveve got 150 messages
              </div>
              <div class="description">
                150 newly unread messages in your inbox
              </div>
              <div class="date pull-left">
                An hour ago
              </div>
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
      <!-- END TOP NAVIGATION MENU -->
      <!-- BEGIN CHAT TOGGLER -->
      <div class="pull-right">
        <ul class="nav quick-section ">
          <!-- <li class="quicklinks">
            <a href="#" class="" id="my-task-list" data-placement="bottom" data-content='' data-toggle="dropdown" data-original-title="Notifications">
              <i class="fa fa-bell" ></i>
              <span class="badge badge-important bubble-only"></span>
            </a>
          </li> -->

          <li class="quicklinks"> <span class="h-seperate"></span></li>
          <li class="quicklinks">
            <a data-toggle="dropdown" class="dropdown-toggle  pull-right " href="#" id="user-options">
              <div class="profile-pic">
                <img src="<?=resize_image(69, $user['image'])?>" alt="" data-src="<?=resize_image(69, $user['image'])?>" data-src-retina="<<?=resize_image(69, $user['image'])?>" width="35" height="35" style="border-radius: 50%"/>
                <div class="availability-bubble online"></div>
              </div>
            </a>
            <ul class="dropdown-menu  pull-right" role="menu" aria-labelledby="user-options">
              <li>
                <a href="<?= base_url('profile'); ?>"> My Profile</a>
              </li>
              <li class="divider"></li>
              <li>
                <a onclick="outConfirm(' <?= base_url('auth/logout'); ?>')" href="#!"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
      <!-- Modal Logout -->
      <script>
        function outConfirm(url) {
          $('#btn-out').attr('href', url);
          $('#outModal').modal();
        }
      </script>
      <!-- END CHAT TOGGLER -->
    </div>
    <!-- END TOP NAVIGATION MENU -->
  </div>
  <!-- END TOP NAVIGATION BAR -->
</div>
<!-- END HEADER -->