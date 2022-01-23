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
          <div class="col-md-10 col-sm-12">
             <div id="login-overlay" class="">
                <div class="modal-content">
                    <div class="modal-body">
                        <h1>Registrasi Akun Siswa</h1>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="well">
                                    <form action="<?= base_url('public/registrasi/save_process'); ?>" method="post">
                                      <!-- load form notfication here -->
                                      <?php $this->load->view('frontend/layout/form_notification'); ?>
                                      <!-- start listing data here -->
                                      <div class="form-row">
                                        <div class="form-group col-md-6">
                                          <label for="name">Nama</label>
                                          <input type="text" class="form-control" id="name" placeholder="Nama Lengkap" max-length="128" required="required" value="<?=set_value('name')?>" name="name">
                                        </div>
                                        <div class="form-group col-md-6">
                                          <label for="nisn">No. Induk</label>
                                          <input type="number" class="form-control" id="nisn" placeholder="No. Induk" required="required" name="nisn" value="<?=set_value('nisn')?>">
                                        </div>
                                      </div>
                                      <div class="form-row">
                                        <div class="form-group col-md-4 col-sm-12">
                                          <label for="tempat_lahir">Tempat Lahir</label>
                                          <input type="text" class="form-control" id="tempat_lahir" placeholder="Tempat Lahir" required="required" name="tempat_lahir" value="<?=set_value('tempat_lahir')?>">
                                        </div>
                                        <div class="form-group col-md-4 col-sm-12">
                                          <label for="tanggal_lahir">Tanggal Lahir</label>
                                           <input type="date" class="form-control" id="tanggal_lahir" placeholder="Tanggal Lahir" required="required" name="tanggal_lahir" value="<?=set_value('tanggal_lahir')?>">
                                        </div>
                                      </div>
                                      <div class="form-row">
                                        <div class="form-group col-md-6">
                                          <label for="alamat">Alamat</label>
                                          <input type="text" class="form-control" id="alamat" placeholder="Alamat" max-length="512" required="required" name="alamat" value="<?=set_value('alamat')?>">
                                        </div>
                                        <div class="form-group col-md-6">
                                          <label for="inputAddress2">No Handphone</label>
                                          <input type="number" class="form-control" id="inputAddress2" placeholder="No Handphone" max-length="13" required="required" name="student_phone" value="<?=set_value('student_phone')?>">
                                        </div>
                                       </div>
                                       <hr>
                                        <div class="form-group">
                                          <label for="inputEmail">Email</label>
                                          <input type="email" class="form-control" id="inputEmail" placeholder="Email" name="email" style="width: 100%" value="<?=set_value('email')?>" required="required" maxlength="100">
                                        </div>
                                        <div class="form-group">
                                          <label for="username">Username</label>
                                          <input type="text" name="username" id="username" class="form-control" placeholder="username" required="required"  pattern="[0-9a-z]{1,20}" title="Username hanya di perbolehkan huruf kecil dan angka saja !" value="<?=set_value('username')?>">
                                          <em style="color : red;">Username hanya di perbolehkan huruf kecil dan angka saja !</em>
                                        </div>
                                        <div class="form-group mb-4">
                                          <label for="password">Password</label>
                                          <input type="password" class="form-control" id="password"  name="password" style="width: 100%" value="" required="required" maxlength="100" placeholder="password" data-toggle="password">
                                        </div>
                                        <div class="form-group mb-4">
                                          <label for="confirm_password">Ulangi Password</label>
                                          <input type="password" class="form-control" id="confirm_password"  name="confirm_password" style="width: 100%" value="" required="required" maxlength="100" placeholder="password" data-toggle="password">
                                        </div>
                                        <input name="login" id="login" class="btn btn-primary" type="submit" value="Daftar" >
                                    </form>
                                    <hr>
                                   <!--  <a href="#!" class="forgot-password-link">Forgot password?</a> -->
                                    <p class="login-wrapper-footer-text">Sudah Mempunyai Akun? <a href="<?= base_url('login') ?>" class="text-reset">Log in Disini</a></p>
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







<script type="text/javascript">
  var password = document.getElementById("password"), confirm_password = document.getElementById("confirm_password");

  function validatePassword(){
    if(password.value != confirm_password.value) {
      confirm_password.setCustomValidity("Password tidak sesuai !!");
    } else {
      confirm_password.setCustomValidity('');
    }
  }
  password.onchange = validatePassword;
  confirm_password.onkeyup = validatePassword;
</script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
      
    });
</script>
