<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>Login E-School</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="Login panel from hellotech.id" name="description" />
    <meta content="Hellotech.id" name="author" />
    <!-- BEGIN PLUGIN CSS -->
    <link href="<?= base_url('assets/') ?>plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="<?= base_url('assets/') ?>plugins/bootstrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/') ?>plugins/bootstrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/') ?>plugins/animate.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/') ?>plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css" />
    <link rel="icon" href="<?= base_url('assets/') ?>/img/favicon.png">
    <!-- END PLUGIN CSS -->
    <!-- BEGIN CORE CSS FRAMEWORK -->
    <link href="<?= base_url('assets/') ?>css/webarch.css" rel="stylesheet" type="text/css" />
    <!-- END CORE CSS FRAMEWORK -->
  </head>
  <!-- END HEAD -->
  <!-- BEGIN BODY -->
  <body class="error-body no-top">
    <div class="container">
      <div class="row login-container column-seperation">
        <div class="col-md-5 col-md-offset-1">
          <h2>
        Sign in E-School
      </h2>
          <p>
            Atau kunjungi Halaman depan kami 
            <!-- <br>
            <a href="#">Check it Now!</a> for a custom manage panel -->
          </p>
          <br>
          <a class="btn btn-block btn-info col-md-8" type="button" href="<?= base_url('/') ?>"><span class="pull-left icon-facebook" style="font-style: italic"></span> <span class="bold">Halaman Public</span></a>
         
        </div>
        <div class="col-md-5">
          <!-- load form notfication here -->
          <?php $this->load->view('backend/layout/form_notification'); ?>
          <!-- start listing data here -->
          <br>
          <form action="<?= base_url('auth'); ?>" class="login-form validate" id="login-form" method="post" name="login-form">
            <div class="row">
              <div class="form-group col-md-10">
                <label class="form-label">Username</label>
                <input type="text" class="form-control" placeholder="Username" required="" id="username" name="username" value="<?= set_value('username'); ?>" />
              <?php echo form_error('username', '<div class="text-danger pl-3">', '</div>'); ?>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-10">
                <label class="form-label">Password</label> <span class="help"></span>
                <input type="password" class="form-control" placeholder="Password" required="" id="password" name="password">
                <?php echo form_error('password', '<div class="text-danger pl-3">', '</div>'); ?>
              </div>
            </div>
            <div class="row">
              <div class="control-group col-md-10">
                <div class="checkbox checkbox check-success">
                  <!-- <a href="#">Lupa Password ?</a>&nbsp;&nbsp; -->
                  <input id="checkbox1" type="checkbox" value="1" name="remember_me">
                  <label for="checkbox1">Ingat Saya</label>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-10">
                <button class="btn btn-primary btn-cons pull-right" type="submit">Login</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- END CONTAINER -->
    <script src="<?= base_url('assets/') ?>plugins/pace/pace.min.js" type="text/javascript"></script>
    <!-- BEGIN JS DEPENDECENCIES-->
    <script src="<?= base_url('assets/') ?>plugins/jquery/jquery-1.11.3.min.js" type="text/javascript"></script>
    <script src="<?= base_url('assets/') ?>plugins/bootstrapv3/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- END CORE JS DEPENDECENCIES-->
    <!-- BEGIN CORE TEMPLATE JS -->
    <script src="<?= base_url('assets/') ?>js/webarch.js" type="text/javascript"></script>
    <!-- END CORE TEMPLATE JS -->
  </body>
</html>