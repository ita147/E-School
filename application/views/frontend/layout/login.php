<style type="text/css">
  .login .btn {
    width: 100%;
    height: 100%;
}
</style>
 <!-- ========================= ABOUT IMAGE =========================-->
<div class="about_bg">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="<?= base_url() ?>"><img src="<?= base_url('assets/') ?>img/logo.png" class="responsive-logo img-fluid" alt="responsive-logo" style="width: 80px;"></a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
                    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown">
                        <span class="icon-menu"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                      <ul class="navbar-nav">
                          <li class="nav-item">
                              <a class="nav-link" href="<?= base_url() ?>">Home</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="<?= base_url('blog') ?>">Info Sekolah</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="<?= base_url('galeri') ?>">Galeri</a>
                          </li>
                          <li class="nav-logo">
                              <a href="<?= base_url() ?>" class="navbar-brand"><img src="<?= base_url('assets/') ?>img/logo.png" style="width: 120px;" class="img-fluid" alt="logo"></a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="<?= base_url('visi-misi') ?>">Visi & Misi</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="<?= base_url('sejarah') ?>">Sejarah</a>
                          </li>     
                          <?php if(empty($user['username'])) {?> 
                          <li class="nav-item">
                              <a class="nav-link" href="<?= base_url('login') ?>">Login</a>
                          </li>  
                          <?php }else {?>
                          <li class="nav-item">
                              <a class="nav-link" href="<?= base_url('/dashboard') ?>">Lihat Panel</a>
                          </li>  
                          <?php } ?>  
                    </ul>
                </div>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="login">
    <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-6">
             <div id="login-overlay" class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <h1>Login</h1>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="well">
                                     <form action="<?= base_url('auth'); ?>" method="post">
                                    <!-- load form notfication here -->
                                    <?php $this->load->view('frontend/layout/form_notification'); ?>
                                    <!-- start listing data here -->
                                    <div class="form-group">
                                      <label for="username">Username</label>
                                      <input type="text" name="username" id="username" class="form-control" placeholder="username / email" required="required">
                                    </div>
                                    <div class="form-group mb-4">
                                      <label for="password">Password</label>
                                      <input type="password" name="password" id="password" class="form-control" placeholder="enter your passsword"  required="required" data-toggle="password">
                                    </div>
                                    <div class="form-group mb-4">
                                      <div class="checkbox checkbox check-success">
                                        <!-- <a href="#">Lupa Password ?</a>&nbsp;&nbsp; -->
                                        <input id="checkbox1" type="checkbox" value="1" name="remember_me">
                                        <label for="checkbox1">Ingat Saya</label>
                                        <a href="<?= base_url('lupa-password') ?>" class="pull-right text-reset">Lupa Password ?</a>
                                      </div>
                                    </div>
                                    <input name="login" id="login" class="btn btn-primary" type="submit" value="Login">
                                  </form>
                                  <br>
                                 <!--  <a href="#!" class="forgot-password-link">Forgot password?</a> -->
                                  <p class="login-wrapper-footer-text">Belum Mempunyai Akun? <a href="<?= base_url('registrasi') ?>" class="text-reset">Daftar Disini</a></p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
  <!--//End Login -->
  <!--============================= FOOTER =============================-->



