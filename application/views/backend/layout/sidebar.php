<div class="page-container row-fluid">
<!-- BEGIN SIDEBAR -->
<div class="page-sidebar " id="main-menu">
  <!-- BEGIN MINI-PROFILE -->
  <div class="page-sidebar-wrapper scrollbar-dynamic" id="main-menu-wrapper">
    <div class="user-info-wrapper sm">
      <div class="profile-wrapper sm">
        <img src="<?=resize_image(69, $user['image'])?>" alt="" data-src="<?=resize_image(69, $user['image'])?>" data-src-retina="<?=resize_image(69, $user['image'])?>" width="69" height="69" />
        <div class="availability-bubble online"></div>
      </div>
      <div class="user-info sm">
        <div class="username"><?=$user['name']?></div>
        <div class="status"><?=ucfirst($user['role_name'])?></div>
      </div>
    </div>
    <!-- END MINI-PROFILE -->
    <!-- BEGIN SIDEBAR MENU -->
    <br>
    <ul>
      <?php 
        $ci = get_instance();
      ?>
      <?php foreach ($sidebar_menu as $m) : ?>
        <?php $active_menu =  ($m['url'] == $ci->uri->segment(1)) ? 'active' : ''; ?>
        <li class="start open <?=$active_menu?>"> 
          <a href="<?= base_url($m['url']); ?>"><i class="<?=$m['icon']?>"></i> 
            <span class="title"><?=$m['name']?></span> 
            <span class="selected"></span>
            <?php if($m['total_submenu'] > 0) {?> 
            <span class="arrow "></span> 
            <?php } ?>
          </a>
          <?php if($m['total_submenu'] > 0) {?>
            <ul class="sub-menu">
            <?php foreach ($m['submenu'] as $sm) : ?>
              <?php $active_sub =  ($sm['url'] == $ci->uri->segment(2)) ? 'active' : ''; ?>
              <li class="<?=$active_sub?>"> <a href="<?= base_url($m['url'].'/'.$sm['url']); ?>"> <?=$sm['name']?> </a> </li>
            <?php endforeach; ?>
            </ul>
          <?php } ?>
        </li>
      <?php endforeach; ?>
      <!-- <li class="start "> <a href="index.html"><i class="fa fa-home"></i> <span class="title">Dashboard</span> <span class="selected"></span> <span class="arrow "></span> </a>
        <ul class="sub-menu">
          <li> <a href="dashboard_v1.html"> Dashboard v1 </a> </li>
          <li class=""> <a href="index.html "> Dashboard v2 <span class=" label label-info pull-right m-r-30">NEW</span></a></li>
        </ul>
      </li> -->
    </ul>
    <div class="clearfix"></div>
    <!-- END SIDEBAR MENU -->
  </div>
</div>
<a href="#" class="scrollup">Scroll</a>
<div class="footer-widget">
  ©Copyright 2020 | <a href="http://SMAN1SUKODADI.id/">SMA N</a>
</div>
<!-- END SIDEBAR -->
<!-- BEGIN PAGE CONTAINER-->
<div class="page-content">
  <!-- BEGIN MAIN CONTENT -->
    