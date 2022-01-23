<!-- Breadcumb positiion -->
<ul class="breadcrumb">
  <li>
    <p>User</p>
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
          <a class="btn btn-warning btn-mini" href="<?= base_url(); ?>user/">
            <i class="fa fa-arrow-left"></i> Kembali </a>
        </div>
        <br>
        <hr>
        <!-- start listing data here -->
        <form action="<?= base_url('user/user/edit_process'); ?>" method="post">
          <input type="hidden" name="id" value="<?= encrypt_url($detail['id']) ?>">
          <div class="row form-row">
            <div class="col-md-12">
              <div class="form-group row">
                <label for="inputName" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputName" placeholder="Title" name="name" style="width: 100%" maxlength="128" required="required" value="<?=$detail['name']?>">
                </div>
              </div>
              <div class="form-group row">
                <label for="inputImage" class="col-sm-2 col-form-label">Foto</label>
                <div class="col-sm-10">
                  <input type="hidden" id="imgField" name="image" value="<?=$detail['image']?>">
                  <object type="image" data="<?= base_url('assets/')?>img/default.jpg">
                    <img src="<?= base_url('upload/')?><?=$detail['image']?>" id="image_preview" style="width: 20%;">
                  </object>
                  
                  <br>
                  <br>
                  <a data-toggle="modal" data-target="#imageModal"  href="javascript:;" class="btn" type="button">Select</a>
                </div>
              </div>
              <div class="form-group row">
                <label  class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">
                  <select class="select2" name="is_active" style="width: 100%" required="">
                    <option value="1" <?php echo ($detail['is_active'] == 1) ?  'selected="selected"' : '' ?>>Aktif</option>
                    <option value="0" <?php echo ($detail['is_active'] == 0) ?  'selected="selected"' : '' ?>> Tidak Aktif</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                  <input type="email" class="form-control" id="inputEmail" placeholder="Email" name="email" style="width: 100%" value="<?=$detail['email']?>" required="required" maxlength="100">
                </div>
              </div>
              <div class="form-group row">
                <label for="inputUsername" class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputUsername" placeholder="username" name="username" style="width: 100%" value="<?=$detail['username']?>" required="required" maxlength="20" onkeyup="this.value=removeSpaces(this.value);" pattern="[0-9a-z]{1,20}" title="Username hanya di perbolehkan huruf kecil dan angka saja !">
                  <em style="color: red">username hanya boleh mengandung unsur angka dan huruf kecil saja !!</em>
                </div>
              </div>
              <div class="form-group row">
                <label for="password" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" id="password"  name="password" style="width: 100%" value="" maxlength="100" pattern="[0-9a-z]{1,100}" title="Password hanya di perbolehkan huruf kecil dan angka saja !">
                  <em style="color: red;">Kosongi password jika tidak ingin diganti </em>
                </div>
              </div>
              <div class="form-group row">
                <label for="confirm_password" class="col-sm-2 col-form-label">Masukan Ulang Password</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" id="confirm_password"  name="confirm_password" style="width: 100%" value=""  maxlength="100">
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

