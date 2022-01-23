<!-- Breadcumb positiion -->
<ul class="breadcrumb">
  <li>
    <p>Panel</p>
  </li>
  <li><a href="#" class="active"><?=$title?></a>
  </li>
</ul>
<!-- Heading Of Page -->
<div class="page-title"> <i class="fa fa-user"></i>
  <h3><?=$title?></h3>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="grid simple ">
      <div class="grid-title no-border">
      </div>
      <div class="grid-body no-border">
        <?php $this->load->view('frontend/layout/form_notification'); ?>
        <?php if($detail['role_id'] != 4){ ?>
           <form role="form" data-parsley-validate="" class="" action="<?php echo base_url() ?>profile/save_process" method="post" enctype="multipart/form-data">
        <?php }else{ ?>
           <form role="form" data-parsley-validate="" class="" action="<?php echo base_url() ?>profile/save_process_member" method="post" enctype="multipart/form-data">
        <?php } ?>
       
            <input type="hidden" name="id" id="id" value="<?= encrypt_url($detail['id']) ?>">
            <div class="row form-row">
              <div class="col-md-12">
                <div class="form-group row">
                  <label for="username" class="col-sm-2 col-form-label">Username</label>
                  <div class="col-sm-10">
                    <input type="text" id="username"  name="username" class="form-control col-md-7 col-xs-12" value="<?= $detail['username']; ?>" readonly required="required" style="width: 100%">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="email" class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-10">
                    <input type="text" id="email" name="email" class="form-control col-md-7 col-xs-12" value="<?= $detail['email']; ?>" required="required">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="fullname" class="col-sm-2 col-form-label">Nama Lengkap</label>
                  <div class="col-sm-10">
                     <input type="fullname" id="name" name="name" class="form-control col-md-7 col-xs-12" value="<?= $detail['name']; ?>" required="required">
                  </div>
                </div>
                <?php if($detail['role_id'] != 4){ ?>
                <div class="form-group row">
                    <label for="inputImage" class="control-label col-md-2 col-sm-2 col-xs-2">Foto</label>
                    <div class="col-md-10 col-sm-10 col-xs-10">
                      <input type="hidden" id="imgField" name="image" value="<?=$user['image']?>">
                      <img src="<?=resize_image(220, $user['image'])?>" id="image_preview" style="max-width: 220px;">
                    
                      <a data-toggle="modal" data-target="#imageModal"  href="javascript:;" class="btn" type="button">Select</a>
                    </div>
                </div>
              <?php }else{ ?>
                 <div class="form-group row">
                    <label for="inputImage" class="control-label col-md-2 col-sm-2 col-xs-2">Foto</label>
                    <div class="col-md-10 col-sm-10 col-xs-10">
                      <input type="file" name="image">
                    </div>
                </div> 
              <?php } ?>
              </div>
              <div class="col-md-12">
                <hr>
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
                <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Simpan</button>
              </div>
            </div>
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
