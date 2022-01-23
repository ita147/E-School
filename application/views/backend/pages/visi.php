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
<div class="page-title"> <i class="fa fa-book"></i>
  <h3><?=$title?></h3>
</div>
<div class="row">
  <form action="<?= base_url('pages/visi/save_process'); ?>" method="post">
    <div class="col-md-12">
      <div class="grid simple ">
        <div class="grid-title no-border">
        </div>
        <div class="grid-body no-border">
          <!-- load form notfication here -->
          <?php $this->load->view('backend/layout/form_notification'); ?>
          <!-- start listing data here -->
          <div class="pull-right">
            <button class="btn btn-success">Simpan <i class="fa fa-save"></i></button>
          </div>
          <br>
          <br>
          <hr>
          <textarea id="content_editor" name="visi"><?=$results['visi']?></textarea>
        </div>
      </div>
    </div>
  </form>
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

