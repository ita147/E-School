<!--============================= HEADER =============================-->
<style type="text/css">
    
    .overlay {
        position: absolute;
        width: 100%;
        height: 100%;
        z-index: 1;
        background-color: #000000;
        opacity: .5;
    }
</style>
<header>
    <div class="container nav-menu">
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
    <div class="slider_img">
        <div id="carousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <?php foreach ($slider as $key => $val) : ?>
                  <li data-target="#demo" data-slide-to="<?=$key?>" class="<?php echo ($key == 0 ? 'active' : '');?>"></li>
                  <?php endforeach; ?>
            </ol>
            <div class="carousel-inner" style="max-height: 550px;">
              <?php foreach ($slider as $key => $val) : ?>
              <div class="carousel-item <?php echo ($key == 0 ? 'active' : '');?>">
                <div class="overlay"></div>
                <img src="<?= base_url('upload/') ?><?=$val['image']?>" alt="<?=$val['title']?>">
                <div class="carousel-caption ">
                  <h5 style="color : <?=$val['text_color']?>;"><?=$val['title']?></h5>
                  <p style="color : <?=$val['text_color']?>;"><?=$val['description']?></p>
                </div>
              </div>
              <?php endforeach; ?>
            </div>
            <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
                <i class="icon-arrow-left fa-slider" aria-hidden="true"></i>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
                <i class="icon-arrow-right fa-slider" aria-hidden="true"></i>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</header>
<!--//END HEADER -->
<!--============================= ABOUT =============================-->
<!--//END HEADER -->
<!--============================= ABOUT =============================-->
<section class="clearfix about">
    <div class="container">
        <div class="row">
            <div class="col-md-8" style="text-align: left !important;">
                <h2>Selamat Datang</h2>
                <?=$banner['text']?>
            </div>
            <div class="col-md-4">
                <h5 style="text-align: center;"><strong>Kepala Sekolah</strong></h5>
                <br>
                <div class="card" style="width: 100%; text-align: center; ">
                  <img src="<?= resize_image(120, $banner['image'])?>" class="card-img-top" alt="..." style="width: 100%; text-align: center; ">
                  <div class="card-body">
                    <br>
                    <h5 class="card-title"><strong><?=$banner['name']?></strong></h5>
                    <p class="card-text">NIP. <?=$banner['nip']?></p>
                    <br>
                  </div>
                </div>
            </div>
        </div>
    </div>
</section>
<hr>
<!--//END ABOUT -->
<!--============================= OUR COURSES =============================-->
<!--//END OUR COURSES -->
<!--============================= EVENTS =============================-->
<section class="event">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h2>Informasi Terbaru</h2>
                <div class="event-img">
                    <span class="event-img_date"><?=date("M , Y", strtotime($last_blog['created_at']))?></span>
                    <img src="<?= resize_image(320 , $last_blog['featured_image'])?>" class="img-fluid" alt="event-img">
                    <div class="event-img_title">
                        <h3><a href="<?= base_url('blog/detail/') ?><?=$last_blog['id']?>/<?=$last_blog['slug']?>"><?=$last_blog['title']?></a></h3>
                        <p><?= word_limiter(strip_tags($last_blog['content']), 10);?></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <h2>Informasi Lain </h2>
                <div class="event-date-slide">
                    <div class="row">
                        <div class="col-md-12">
                            <?php foreach ($blog as $val) : ?>
                            <div class="event_date">
                                <div class="event-date-wrap">
                                    <p><?=date("D", strtotime($val['created_at']))?></p>
                                    <span><?=date("M , Y", strtotime($val['created_at']))?></span>
                                </div>
                            </div>
                            <div class="date-description">
                                <h3><a href="<?= base_url('blog/detail/') ?><?=$val['id']?>/<?=$val['slug']?>"><?=$val['title']?></a></h3>
                                <p><?= word_limiter(strip_tags($val['content']), 30);?></p>
                                <hr class="event_line">
                            </div>
                            <?php endforeach;?>
                            
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </div>
</section>
<!--//END EVENTS -->