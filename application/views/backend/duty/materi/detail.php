 <link href="<?= base_url('assets/') ?>plugins/video-js/video-js.css" rel="stylesheet" />

  <!-- If you'd like to support IE8 (for Video.js versions prior to v7) -->
  <script src="<?= base_url('assets/') ?>plugins/video-js/videojs-ie8.min.js"></script>


<!-- Breadcumb positiion -->
<ul class="breadcrumb">
  <li>
    <p>Tugas & Materi</p>
  </li>
  <li>
    <a href="#">Materi</a>
  </li>
  <li><a href="#" class="active"><?=$title?></a>
  </li>
</ul>
<!-- Heading Of Page -->
<div class="page-title"> <i class="fa fa-archive"></i>
  <h3><?=$title?></h3>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="grid simple ">
      <div class="grid-title no-border">
      </div>
      <div class="grid-body no-border">
        <!-- load form notfication here -->
        <?php $this->load->view('backend/layout/form_notification'); ?>
        <!-- start listing data here -->
        <div class="pull-right">
          <a class="btn btn-warning btn-mini" href="<?= base_url(); ?>duty/materi">
            <i class="fa fa-arrow-left"></i> Kembali </a>
        </div>
        <br>
        <br>
        <hr>
        <!-- start listing data here -->
        <div class="form-group row">
          <label for="inputTitle" class="col-sm-2 col-form-label"><b>Judul</b></label>
          <div class="col-sm-10">
           <?=$results['title']?>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputTitle" class="col-sm-2 col-form-label"><b>Deskripsi</b></label>
          <div class="col-sm-10">
           <?=$results['description']?>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputTitle" class="col-sm-2 col-form-label"><b>Tipe</b></label>
          <div class="col-sm-10">
           <?php echo ($results['type'] == 'file') ?  'File' : 'Video' ?>
          </div>
        </div>
        <?php if($results['type'] == 'file') { ?>
          <div class="form-group row">
            <label for="inputTitle" class="col-sm-2 col-form-label"><b></b></label>
            <div class="col-sm-10">
             <a class="btn btn-primary btn-mini" href="<?= base_url(); ?>panelsiswa/materi/download/<?= encrypt_url($results['id']) ?>">
                <i class="fa fa-download"></i> Download Materi
            </a>
            </div>
          </div>
        <?php }else{ ?>
          <hr>
          <div class="row center" style="height: 720px;">
            <div class="col-md-12">
              <video
                id="my-video"
                class="video-js"
                controls
                preload="auto"
                responsive="TRUE"
                data-setup="{}" style="max-width: 100%; height: auto"
              >
                <source src="<?= base_url(); ?>upload/<?=$results['file']?>"/>
                <p class="vjs-no-js">
                  To view this video please enable JavaScript, and consider upgrading to a
                  web browser that
                  <a href="https://videojs.com/html5-video-support/" target="_blank"
                    >supports HTML5 video</a
                  >
                </p>
              </video>
            </div>
          </div>
      <?php } ?>  
      </div>
    </div>
  </div>
</div>

<script src="<?= base_url('assets/') ?>plugins/video-js/video.js"></script>
