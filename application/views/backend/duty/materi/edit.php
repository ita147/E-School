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
          <a class="btn btn-warning btn-mini" href="<?= base_url(); ?>duty/materi">
            <i class="fa fa-arrow-left"></i> Kembali </a>
        </div>
        <br>
        <br>
        <hr>
        <!-- start listing data here -->
        <form action="<?= base_url('duty/materi/edit_process'); ?>" method="post">
          <input type="hidden" name="id" value="<?= encrypt_url($results['id']) ?>" reqired="reqired">
          <div class="row form-row">
            <div class="col-md-6 col-sm-12">
              <div class="form-group row">
                <label for="inputTitle" class="col-sm-2 col-form-label">Judul</label>
                <div class="col-sm-10">
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
                <label  class="col-sm-2 col-form-label">Kategori</label>
                <div class="col-sm-10">
                  <select class="select2" name="categories_id" style="width: 100%" required="required">
                    <option></option>
                    <?php foreach ($categories as $val) : ?>
                      <option value="<?=$val['id']?>" <?php echo ($results['categories_id'] == $val['id']) ?  'selected="selected"' : '' ?>><?=$val['name']?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
             <!--  <div class="form-group row">
                <label  class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">
                  <select class="select2" name="is_publish" style="width: 100%" required="required">
                    <option value="1" <?php echo ($results['is_publish'] == 1) ?  'selected="selected"' : '' ?>>Publik</option>
                    <option value="0" <?php echo ($results['is_publish'] == 0) ?  'selected="selected"' : '' ?>>Hanya Member</option>
                  </select>
                </div>
              </div> -->
              <div class="form-group row">
                <label  class="col-sm-2 col-form-label">Type</label>
                <div class="col-sm-10">
                  <select class="select2" name="type" style="width: 100%" required="required">
                    <option value="file" <?php echo ($results['type'] == 'file') ?  'selected="selected"' : '' ?>>File</option>
                    <option value="video" <?php echo ($results['type'] == 'video') ?  'selected="selected"' : '' ?>>Video</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="fileField" class="col-sm-2 col-form-label">File</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="fileField" placeholder="File" name="file" style="width: 100%" value="<?=$results['file']?>" maxlength="128" required="required" readonly>
                  <a data-toggle="modal" data-target="#fileModal"  href="javascript:;" class="btn" type="button">Select</a>
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
<?php $this->load->view('backend/duty/materi/modals'); ?>
<!-- java script start here -->
<script>
    function deleteConfirm(url) {
        $('#btn-delete').attr('href', url);
        $('#deleteModal').modal();
    }

    $(document).ready(function() {
        $('.select2').select2();
      
    });

</script>

