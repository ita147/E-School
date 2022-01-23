<!-- Breadcumb positiion -->
<ul class="breadcrumb">
  <li>
    <p>Pages</p>
  </li>
  <li><a href="#" class="">Slider</a>
  </li>
  <li><a href="#" class="active"><?=$title?></a>
  </li>
</ul>
<!-- Heading Of Page -->
<div class="page-title"> <i class="fa fa-file-text"></i>
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
          <a class="btn btn-warning btn-mini" href="<?= base_url(); ?>pages/galeri/">
            <i class="fa fa-arrow-left"></i> Kembali </a>
        </div>
        <br>
        <hr>
        <!-- start listing data here -->
        <form action="<?= base_url('pages/galeri/edit_process'); ?>" method="post">
          <input type="hidden" name="id" value="<?= encrypt_url($results['id']) ?>">
          <div class="row form-row">
            <div class="col-md-12">
              <div class="form-group row">
                <label for="inputName" class="col-sm-2 col-form-label">Judul</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputName" placeholder="Title" name="title" style="width: 100%" value="<?=$results['title']?>" maxlength="256" required="required">
                </div>
              </div>
              <div class="form-group row">
                <label for="description" class="col-sm-2 col-form-label">Deskripsi</label>
                <div class="col-sm-10">
                  <textarea name="description" class="form-control" style="width: 100%" rows="10" id="description" maxlength="200"><?=set_value('description')?><?=$results['description']?></textarea>
                </div>
              </div>
              
              <div class="form-group row">
                <label for="inputImage" class="col-sm-2 col-form-label">Foto</label>
                <div class="col-sm-10">
                  <input type="hidden" id="imgField" name="image" value="<?=$results['image']?>">
                  <object type="image" data="<?= base_url('assets/')?>img/default.jpg">
                    <img src="<?= base_url('upload/')?><?=$results['image']?>" id="image_preview" style="width: 20%;">
                  </object>
                  <br>
                  <br>
                  <a data-toggle="modal" data-target="#imageModal"  href="javascript:;" class="btn" type="button">Select</a>
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

