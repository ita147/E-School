    <footer>
        <div class="container">
          <div class="row">
            <div class="col-md-3">
                <div class="foot-logo">
                    <a href="index.html">
                        <img src="<?= base_url('assets/') ?>img/logo.png" class="img-fluid" alt="footer_logo" style="width: 120px;">
                    </a>
                    <p>2020 © 
                    <br> All rights reserved.</p>
                </div>
            </div>
            <div class="col-md-2">
                <div class="sitemap">
                    <h3>Navigasi</h3>
                    <ul>
                      <li >
                        <a href="<?= base_url('') ?>">Home</a>
                      </li>
                      <li >
                        <a href="<?= base_url('visi-misi') ?>">Visi Misi</a>
                      </li>
                      <li >
                        <a href="<?= base_url('sejarah') ?>">Sejarah</a>
                      </li>
                      <li >
                        <a href="<?= base_url('galeri') ?>">Galeri</a>
                      </li>
                      <li >
                        <a href="<?= base_url('blog') ?>">Info</a>
                      </li>
                      <li >
                        <a href="<?= base_url('login') ?>">Login</a>
                      </li>
                      <li >
                        <a href="<?= base_url('registrasi') ?>">Registrasi</a>
                      </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <div class="address">
                    <h3>SMA N 1 </h3>
                    <p>Selamat datang di SMA N </br>Mohon gunakan sistem ini dengan baik dan bijak</p>
                </div>  
            </div>
            <div class="col-md-3">
                <div class="address">
                    <h3>Kontak Kami </h3>
                    <p><span>Alamat: </span> <?=$app_info['address']?></p>
                    <p>Email : <?=$app_info['gmail']?>
                        <br> No.Telephon : <?=$app_info['No_Telp']?></p>
                        <ul class="footer-social-icons">
                            <?=($app_info['instagram'] != '') ? '<li><a href="'.$app_info['instagram'].'" class="instagram"><i class="fab fa-instagram" style="font-size: 25px;"></i></a></li>' : ''?>
                              <?=($app_info['facebook'] != '') ? '<li><a href="'.$app_info['facebook'].'" class="facebook"><i class="fab fa-facebook" style="font-size: 25px;"></i></a></li>' : ''?>
                              <?=($app_info['twitter'] != '') ? '<li><a href="'.$app_info['twitter'].'" class="twitter"><i class="fab fa-twitter" style="font-size: 25px;"></i></a></li>' : ''?>
                              <?=($app_info['youtube'] != '') ? '<li><a href="'.$app_info['youtube'].'" class="youtube"><i class="fab fa-youtube" style="font-size: 25px;"></i></a></li>' : ''?>
                             
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--//END FOOTER -->
    <!-- jQuery, Bootstrap JS. -->
    <script src="<?= base_url('assets/') ?>public2/js/jquery.min.js"></script>
    <script src="<?= base_url('assets/') ?>public2/js/tether.min.js"></script>
    <script src="<?= base_url('assets/') ?>public2/js/bootstrap.min.js"></script>
    <!-- Plugins -->
    <script src="<?= base_url('assets/') ?>public2/js/slick.min.js"></script>
    <script src="<?= base_url('assets/') ?>public2/js/waypoints.min.js"></script>
    <script src="<?= base_url('assets/') ?>public2/js/counterup.min.js"></script>
    <script src="<?= base_url('assets/') ?>public2/js/instafeed.min.js"></script>
    <script src="<?= base_url('assets/') ?>public2/js/owl.carousel.min.js"></script>
    <script src="<?= base_url('assets/') ?>public2/js/validate.js"></script>
    <script src="<?= base_url('assets/') ?>public2/js/jquery-ui-1.10.4.min.js"></script>
     <script src="<?= base_url() ?>assets/js/bootstrap-show-password3.js"></script>
    <script src="<?= base_url('assets/') ?>public2/js/jquery.isotope.min.js"></script>
    <script src="<?= base_url('assets/') ?>public2/js/animated-masonry-gallery.js"></script>
    <!-- Magnific popup JS -->
    <script src="<?= base_url('assets/') ?>public2/js/jquery.magnific-popup.js"></script>
    <!-- Subscribe -->
    <script src="<?= base_url('assets/') ?>public2/js/subscribe.js"></script>
    <!-- Script JS -->
    <script src="<?= base_url('assets/') ?>public2/js/script.js"></script>
</body>




