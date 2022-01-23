 <link rel="stylesheet" type="text/css" href="<?= base_url('assets/') ?>public2/css/normalize.css" />
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/') ?>public2/css/set2.css" />
<link rel="stylesheet" href="<?= base_url('assets/') ?>public2/css/magnific-popup.css">
<link href="<?= base_url('assets/') ?>public2/css/animated-masonry-gallery.css" rel="stylesheet" type="text/css" />
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

  <!--//END ABOUT IMAGE -->
  <!--============================= Gallery =============================-->
<div class="gallery-wrap">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1 class="gallery-style">Galeri Sekolah</h1>
      </div>
    </div>
    <div class="row">
      <?php foreach ($results as $val) : ?>
      <div class="col-md-4">
        <a href="<?= resize_image(500, $val['image'])?>" class="grid image-link">
          <figure class="effect-bubba gallery-img-wrap">
            <img src="<?= resize_image(200, $val['image'])?>" class="img-fluid" alt="#">
            <figcaption>
             <p><i class="fa fa-search-plus fa-2x" aria-hidden="true"></i><?=$val['title']?> - <?=$val['description']?></p>
           </figcaption>     
         </figure>
       </a>
      </div>
      <?php endforeach;?>
      
    </div>
  </div>
</div>












