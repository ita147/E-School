<!-- load css here -->
<link href="<?= base_url('assets/') ?>plugins/bootstrap-select2/select2.css" rel="stylesheet" type="text/css" media="screen" />
<!-- load js here -->
<script src="<?= base_url('assets/') ?>plugins/bootstrap-select2/select2.min.js" type="text/javascript"></script>
<!-- Breadcumb positiion -->
<ul class="breadcrumb">
  <li>
    <p>Settings</p>
  </li>
  <li><a href="#" class="active">API's Settings</a>
  </li>
</ul>
<!-- Heading Of Page -->
<div class="page-title"> <i class="fa fa-gear"></i>
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
        <form action="<?= base_url('setting/api/save_process'); ?>" method="post">
          <div class="row form-row">
            <div class="col-md-12">
              <h5><b>Gmail Sender</b></h5>
              <br>
              <div class="form-group row">
                <label for="mailsender_address" class="col-sm-2 col-form-label">Mail Address</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="mailsender_address" placeholder="" name="mailsender_address" value="<?=$results['mailsender_address']?>">
                </div>
              </div>
              <div class="form-group row">
                <label for="mailsender_password" class="col-sm-2 col-form-label">Mail Password</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="mailsender_password" placeholder="" name="mailsender_password" value="<?=$results['mailsender_password']?>">
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

