<!-- load js here -->
<script src="<?= base_url('assets/') ?>plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
<!-- Breadcumb positiion -->
<ul class="breadcrumb">
  <li>
    <p>Pages</p>
  </li>
  <li><a href="#" class="active"><?=$title?></a></li>
</ul>
<!-- Heading Of Page -->
<div class="page-title"> <i class="fa fa-globe"></i>
  <h3><?=$title?></h3>
</div>
<div class="row">
  <form action="<?= base_url('homepage/banner/save_process'); ?>" method="post">
    <div class="col-md-12">
      <div class="grid simple ">
        <div class="grid-title no-border">
        </div>
        <div class="grid-body no-border">
          <div class="pull-right">
            <button class="btn btn-success">Simpan <i class="fa fa-save"></i></button>
          </div>
          <br>
          <br>
          <hr>
          <!-- load form notfication here -->
          <?php $this->load->view('backend/layout/form_notification'); ?>
          <!-- start listing data here -->
          <div class="form-group row">
              <label for="inputName" class="col-sm-2 col-form-label">Nama Kepsek</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="inputName" placeholder="Nama" name="name" style="width: 100%" value="<?=$results['name']?>" maxlength="100" required="required">
              </div>
            </div>
            <div class="form-group row">
              <label for="inputNIP" class="col-sm-2 col-form-label">NIP</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="inputNIP" placeholder="NIP" name="nip" style="width: 100%" value="<?=$results['nip']?>" maxlength="100" required="required">
              </div>
            </div>
          <div class="form-group row">
            
            <label for="inputImage" class="col-sm-2 col-form-label">Foto</label>
            <div class="col-sm-10">
              <input type="hidden" id="imgField" name="image" value="<?=$results['image']?>">
              <object type="image/png/jpeg/jpg" data="<?= base_url('assets/')?>img.jpg" style="width: 15%;" id="image_preview_obj">
                <img src="<?= base_url('upload/')?><?=$results['image']?>" id="image_preview" style="width: 15%;">
              </object>
              <br>
              <br>
              <a data-toggle="modal" data-target="#imageModal"  href="javascript:;" class="btn" type="button">Select</a>
            </div>
          </div>
          <br>
          <div class="form-group row">
          <textarea id="content_editor" name="text" class="col-md-12" ><?=$results['text']?></textarea>
          </div>
        </div>
      </div>
    </div>
  </form>
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
    function deleteConfirm(url) {
        $('#btn-delete').attr('href', url);
        $('#deleteModal').modal();
    }
</script>
<script>
CKEDITOR.replace( 'content_editor' ,{
  filebrowserBrowseUrl : '<?= base_url('includes/') ?>filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
  height: '500px'   
});
$(document).ready(function() {
    $('.select2').select2();
});
</script>
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


