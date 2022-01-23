<!-- Breadcumb positiion -->
<ul class="breadcrumb">
  <li>
    <p>Guru</p>
  </li>
  <li><a href="#" class="active"><?=$title?></a>
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
        <div class="pull-right">
          <a class="btn btn-warning btn-mini" href="<?= base_url(); ?>pengajar/">
            <i class="fa fa-arrow-left"></i> Kembali </a>
        </div>
        <br>
        <hr>
        <!-- start listing data here -->
        <form action="<?= base_url('pengajar/add_process'); ?>" method="post">
          <div class="row form-row">
            <div class="col-md-12">
              <div class="form-group row">
                <label for="inputName" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputName" placeholder="Title" name="name" style="width: 100%" value="<?=set_value('name')?>" maxlength="128" required="required">
                </div>
              </div>
              <div class="form-group row">
                <label for="inputriwayat_pendidikan" class="col-sm-2 col-form-label">Riwayat Pendidikan</label>
                <div class="col-sm-10">
                  <textarea name="riwayat_pendidikan" class="form-control" style="width: 100%" rows="10" id="inputriwayat_pendidikan"><?=set_value('riwayat_pendidikan')?></textarea>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputPhone" class="col-sm-2 col-form-label">Nomor Telepon</label>
                <div class="col-sm-10">
                  <input type="phone" class="form-control" id="form" placeholder="Nomor Telepon" name="phone" style="width: 100%" value="<?=set_value('phone')?>" maxlength="20" >
                </div>
              </div>
              <div class="form-group row">
                <label  class="col-sm-2 col-form-label">Kelas ajar</label>
                <div class="col-sm-10">
                  <select class="select2" name="kelas_id[]" multiple style="width: 100%">
                    <?php foreach ($kelas as $val) : ?>
                      <option value="<?=$val['id']?>"><?=$val['name']?></option>
                    <?php endforeach; ?>
                  </select>
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
              <br>
              <hr>
              <div class="form-group row">
                <label  class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">
                  <select class="select2" name="is_active" style="width: 100%" required="">
                    <option value="1" <?php echo (set_value('is_active') == 1) ?  'selected="selected"' : '' ?>>Aktif</option>
                    <option value="0" > TidakAktif</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                  <input type="email" class="form-control" id="inputEmail" placeholder="Email" name="email" style="width: 100%" value="<?=set_value('email')?>" required="required" maxlength="100">
                </div>
              </div>
              <div class="form-group row">
                <label for="inputUsername" class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputUsername" placeholder="username" name="username" style="width: 100%" value="<?=set_value('username')?>" required="required" maxlength="20" onkeyup="this.value=removeSpaces(this.value);" pattern="[0-9a-z]{1,20}" title="Username hanya di perbolehkan huruf kecil dan angka saja !">
                  <em style="color: red">username hanya boleh mengandung unsur angka dan huruf kecil saja !!</em>
                </div>
              </div>
              <div class="form-group row">
                <label for="password" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" id="password"  name="password" style="width: 100%" value="" required="required" maxlength="100" pattern="[0-9a-z]{1,100}" title="Password hanya di perbolehkan huruf kecil dan angka saja !">
                </div>
              </div>
              <div class="form-group row">
                <label for="confirm_password" class="col-sm-2 col-form-label">Masukan Ulang Password</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" id="confirm_password"  name="confirm_password" style="width: 100%" value="" required="required" maxlength="100">
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
    function deleteConfirm(url) {
        $('#btn-delete').attr('href', url);
        $('#deleteModal').modal();
    }

    function removeSpaces(string) {
      if (string.includes(" ")) {
        alert("Username tidak boleh berspasi !!");
      }
     return string.split(' ').join('');
    }

    function responsive_filemanager_callback(field_id){
      console.log(field_id);
      var url=jQuery('#'+field_id).val();
      //your code
      $('#image_preview').attr("src", "<?= base_url(); ?>/upload/"+url);
      $('#image_preview_obj').attr("data", "<?= base_url(); ?>/upload/"+url);
    }

    var password = document.getElementById("password"), confirm_password = document.getElementById("confirm_password");

    function validatePassword(){
      if(password.value != confirm_password.value) {
        confirm_password.setCustomValidity("Passwords Don't Match");
      } else {
        confirm_password.setCustomValidity('');
      }
    }
    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;

    $(document).ready(function() {
        $('.select2').select2();
      
    });
</script>
