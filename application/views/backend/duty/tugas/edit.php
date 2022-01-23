<script src="<?= base_url('assets/') ?>plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
<!-- load js here -->
<script src="<?= base_url('assets/') ?>plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<!-- load css here -->
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/') ?>plugins/bootstrap-datepicker/css/datepicker.min.css">
<script type="text/javascript">
  $(document).ready(function() {
      $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
      });
  });
</script>
<!-- Breadcumb positiion -->
<ul class="breadcrumb">
  <li>
    <p>Tugas & Materi</p>
  </li>
  <li>
    <a href="#">Tugas</a>
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
          <a class="btn btn-warning btn-mini" href="<?= base_url(); ?>duty/tugas">
            <i class="fa fa-arrow-left"></i> Kembali </a>
        </div>
        <br>
        <br>
        <hr>
        <!-- start listing data here -->
        <form action="<?= base_url('duty/tugas/edit_process'); ?>" method="post">
          <input type="hidden" name="id" value="<?= encrypt_url($results['id']) ?>" reqired="reqired">
          <div class="row form-row">
            <div class="col-md-12 col-sm-12">
              <div class="form-group row">
                <label for="inputTitle" class="col-sm-2 col-md-2 col-form-label">Judul</label>
                <div class="col-sm-10 col-md-6">
                  <input type="text" class="form-control" id="inputTitle" placeholder="Title" name="title" style="width: 100%" value="<?=$results['title']?>" maxlength="128" required="required">
                </div>
              </div>
              <div class="form-group row">
                <label for="input_description" class="col-sm-2 col-form-label">Deskripsi</label>
                <div class="col-sm-10">
                  <textarea name="description" class="form-control" style="width: 100%" rows="10" id="input_description" maxlength="256"><?=$results['description']?></textarea>
                </div>
              </div>
              <div class="form-group row">
                <label  class="col-sm-2 col-md-2 col-form-label">Kategori</label>
                <div class="col-sm-10 col-md-3">
                  <select class="select2" name="categories_id" style="width: 100%" required="required">
                    <option></option>
                    <?php foreach ($categories as $val) : ?>
                      <option value="<?=$val['id']?>" <?php echo ($results['categories_id'] == $val['id']) ?  'selected="selected"' : '' ?>><?=$val['name']?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-md-2 col-form-label">Max Upload</label>
                <div class="col-sm-8 col-md-6">
                  <div class="input-append success date col-md-10 col-lg-6 no-padding">
                    <input type="text" class="form-control datepicker" name="max_upload" value="<?=$results['max_upload']?>" required="required">
                    <span class="add-on"><span class="arrow"></span><i class="fa fa-th"></i></span>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label for="fileField" class="col-sm-2 col-form-label">File</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="fileField" placeholder="File" name="file" style="width: 100%" value="<?=$results['file']?>" maxlength="128" readonly>
                  <a data-toggle="modal" data-target="#fileModal"  href="javascript:;" class="btn" type="button">Select</a>
                  <em style="color : red;">Optional jika ada lampiran**</em>
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
<?php $this->load->view('backend/duty/tugas/modals'); ?>
<!-- java script start here -->
<script>
    function deleteConfirm(url) {
        $('#btn-delete').attr('href', url);
        $('#deleteModal').modal();
    }

    $(document).ready(function() {
        $('.select2').select2();
      
    });

    CKEDITOR.replace( 'input_description' ,{
      filebrowserBrowseUrl : '<?= base_url('includes/') ?>filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
      height: '500px'   
    });
</script>

