<!-- load css here -->
<link href="<?= base_url('assets/') ?>plugins/bootstrap-select2/select2.css" rel="stylesheet" type="text/css" media="screen" />
<!-- load js here -->
<script src="<?= base_url('assets/') ?>plugins/bootstrap-select2/select2.min.js" type="text/javascript"></script>
<!-- Breadcumb positiion -->
<ul class="breadcrumb">
  <li>
    <p>Settings</p>
  </li>
  <li><a href="#" class="active">General Settings</a>
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
        <form action="<?= base_url('setting/social/save_process'); ?>" method="post">
          <div class="row form-row">
            <div class="col-md-12">
              <div class="form-group row">
                <label for="inputInstagrram" class="col-sm-2 col-form-label">Instagram</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputInstagrram" placeholder="Instagram URL" name="instagram"  value="<?=$results['instagram']?>">
                </div>
              </div>
              <div class="form-group row">
                <label for="inputFacebook" class="col-sm-2 col-form-label">Facebook</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputFacebook" placeholder="Facebook URL" name="facebook"  value="<?=$results['facebook']?>">
                </div>
              </div>
              <div class="form-group row">
                <label for="inputYT" class="col-sm-2 col-form-label">Youtube</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputYT" placeholder="Youtube URL" name="youtube"  value="<?=$results['youtube']?>">
                </div>
              </div>
              <div class="form-group row">
                <label for="inputWa" class="col-sm-2 col-form-label">Whatsapp</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputWa" placeholder="Whatapps Phone" name="whatapps"  value="<?=$results['whatapps']?>">
                </div>
              </div>
              <div class="form-group row">
                <label for="inputGM" class="col-sm-2 col-form-label">GMail</label>
                <div class="col-sm-10">
                  <input type="email" class="form-control" id="inputGM" placeholder="Gmail" name="gmail"  value="<?=$results['gmail']?>">
                </div>
              </div>
              <!-- <div class="form-group row">
                <label for="inputLI" class="col-sm-2 col-form-label">LinkedIn</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputLI" placeholder="LinkedIn" name="linkedin"  value="<?=$results['linkedin']?>">
                </div>
              </div> -->
              <div class="form-group row">
                <label for="inputT" class="col-sm-2 col-form-label">Twitter</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputT" placeholder="twitter" name="twitter"  value="<?=$results['twitter']?>">
                </div>
              </div>
              <div class="form-group row">
                <label for="inputTlp" class="col-sm-2 col-form-label">No.Telp</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputTlp" placeholder="telphone" name="No_Telp"  value="<?=$results['No_Telp']?>">
                </div>
              </div>
              <div class="form-group row">
                <label for="inputAlamat" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                  <textarea id="inputAlamat" rows="4" cols="60" name="address"><?=$results['address']?></textarea>
                </div>
              </div>
              <br>
              <div class="form-group row">
                <div class="col-md-12">
                  <em>Last Updated On : <?=$results['last_updated']?></em>
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

