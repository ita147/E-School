<!-- Breadcumb positiion -->
<ul class="breadcrumb">
  <li>
    <p>Homepage</p>
  </li>
  <li><a href="#" class="">Galeri</a>
  </li>
  <li><a href="#" class="active"><?=$title?></a>
  </li>
</ul>
<!-- Heading Of Page -->
<div class="page-title"> <i class="fa fa-globe"></i>
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
        <div class="pull-right">
          <a class="btn btn-warning btn-mini" href="<?= base_url(); ?>homepage/galeri/">
            <i class="fa fa-arrow-left"></i> Kembali </a>
        </div>
        <br>
        <hr>
        <!-- start listing data here -->
        <form action="<?= base_url('homepage/galeri/add_process'); ?>" method="post">
          <div class="row form-row">
            <div class="col-md-12">
              <div class="form-group row">
                <label for="inputName" class="col-sm-2 col-form-label">Judul</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputName" placeholder="Title" name="title" style="width: 100%" value="<?=set_value('title')?>" maxlength="256" required="required">
                </div>
              </div>
              <div class="form-group row">
                <label for="description" class="col-sm-2 col-form-label">Deskripsi</label>
                <div class="col-sm-10">
                  <textarea name="description" class="form-control" style="width: 100%" rows="10" id="description"><?=set_value('description')?></textarea>
                </div>
              </div>
              
              <div class="form-group row">
                <label for="inputImage" class="col-sm-2 col-form-label">Foto</label>
                <div class="col-sm-10">
                  <input type="hidden" id="imgField" name="image" value="<?=set_value('image')?>">
                  <object type="image/png" data="<?= base_url('assets/')?>img/default.jpg" style="width: 20%;" id="image_preview_obj">
                    <img src="<?= base_url('upload/')?><?=set_value('image')?>" id="image_preview" >
                  </object>
                  <br>
                  <br>
                  <a data-toggle="modal" data-target="#imageModal"  href="javascript:;" class="btn" type="button">Select</a>
                </div>
              </div>

              <div class="form-group row">
                <label for="text_color" class="col-sm-2 col-form-label">Warna Text</label>
                <div class="col-sm-10">
                  <input type="color" class="form-control" id="text_color" placeholder="Warna Text" name="text_color" style="width: 50%" value="#ffffff" maxlength="10">
                </div>
              </div>
            </div>
          </div>
          <br>
          <br>
          <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- load modal here -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
              <iframe style="width: 100%" height="450" src="<?= base_url() ?>includes/filemanager/dialog.php?type=1&field_id=imgField&relative_url=1&multiple=0" frameborder="0" style="overflow: scroll; overflow-x: hidden; overflow-y: scroll; "></iframe>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          </div>
        </div>
    </div>
</div>
<!-- java script start here -->
<script>
    function responsive_filemanager_callback(field_id){
      console.log(field_id);
      var url=jQuery('#'+field_id).val();
      //your code
      $('#image_preview').attr("src", "<?= base_url(); ?>/upload/"+url);
      $('#image_preview_obj').attr("data", "<?= base_url(); ?>/upload/"+url);
    }
</script>

