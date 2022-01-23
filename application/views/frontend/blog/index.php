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
<!--============================= BLOG =============================-->
<section class="blog-wrap">
    <div class="container">
        <div class="row">
            <div class="col-md-12"><h1>Info Sekolah</h1></div>
            <br>
            <br>
            <br>
            <br>
            <br>
            <hr>
            <div class="col-md-8">
                <?php foreach ($results as $val) : ?>
                <div class="blog-single-item">
                    <div class="blog-img_block">
                        <img src="<?= resize_image(720 , $val['featured_image'])?>" class="img-fluid" alt="blog-img">
                        <div class="blog-date">
                            <span><?=date("F j, Y", strtotime($val['created_at']))?></span>
                        </div>
                    </div>
                    <div class="blog-tiltle_block">
                        <h4><a href="<?= base_url('blog/detail/') ?><?=$val['id']?>/<?=$val['slug']?>"><?=$val['title']?></a></h4>
                        <h6> <a href="#"><i class="fa fa-user" aria-hidden="true"></i><span>admin</span> </a>  |   <a href="#"><i class="fa fa-tags" aria-hidden="true"></i><span>Education</span></a></h6>
                        <?= word_limiter(strip_tags($val['content']), 30);?>
                        <a href="<?= base_url('blog/detail/') ?><?=$val['id']?>/<?=$val['slug']?>">Read More</a>
                       
                    </div>
                </div>
                <hr>
                <?php endforeach;?>
                <!-- // end .blog-single -->
                <nav>
                    <?=$links?>
                </nav>
            </div>
            <div class="col-md-4">
                <form class="widget_search border-radius" action="<?= base_url('blog') ?>" method="get">
                  <input type="text" placeholder="Search" class="blog-search" name="search">
                  <button type="submit" class="btn btn-warning btn-blogsearch">SEARCH</button>
                </form>
                    
                </form>
                <div class="blog-category_block">
                    <h3>Category</h3>
                    <ul>
                        <?php foreach ($categories as $val) : ?>
                        <li><a href="<?= base_url('blog/categories/') ?><?=$val['slug']?>"><?=$val['name']?></
                        <?php endforeach; ?>
                    </ul>
                </div>
              
                <div class="blog-tags_wrap">
                    <div class="row">
                        <div class="col-md-12">
                            <h3>Tags</h3>
                        </div>
                        <?php foreach ($tags as $val) : ?>
                        <a href="<?= base_url('blog/categories/') ?><?=$val['slug']?>" class="blog-tags">
                            <span><?=$val['name']?></span>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

