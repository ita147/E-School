<!-- Breadcumb positiion -->
<ul class="breadcrumb">
  <li>
    <p>Member</p>
  </li>
  <li><a href="#" class="active"><?=$title?></a>
  </li>
</ul>
<!-- Heading Of Page -->
<div class="page-title"> <i class="fa fa-users"></i>
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
        <div class="row">
          <form action="<?= base_url('member/member/search_process'); ?>" method="post">
            <div class="col-md-3 col-sm-12" style="padding-top: 10px;">
              <input type="text" class="form-control" name="name" placeholder="Nama Siswa/Alumni/NISN" value="<?=$name?>">
            </div>
            <div class="col-md-3 col-sm-12" style="padding-top: 10px;">
                <select class="form-control select2" name="status" placeholder="--Pilih Status--">
                  <option></option>
                  <option value="0" <?php echo ($status == '0' ? 'selected="selected"'  : ''); ?>>Alumni</option>
                  <option value="1" <?php echo ($status == '1' ? 'selected="selected"'  : ''); ?>>Siswa Aktif</option>
                  
                </select>
            </div>
            <div class="col-md-6 col-sm-12" style="padding-top: 10px;">
              <button type="submit" class="btn btn-default" value="show" name="submit"><i class="fa fa-search"></i> Tampil</button>
              <button type="submit" class="btn btn-danger" value="reset" name="submit"><i class="fa fa-circle"></i>  Reset</button>
              <a class="btn btn-success" href="<?= base_url(); ?>member/member/add_member">
              <i class="fa fa-plus"></i> Tambah Member </a>
            </div>
          </form>
         
        </div>
        <br>
        <br>
        <div class="table-responsive">
          <table class="table table-bordered" >
            <thead>
              <tr>
                <th width="5%">No</th>
                <th width="15%">Username / E-Mail</th>
                <th width="10%">NISN</th>
                <th width="5%">Status Akun</th>
                <th width="5%">Status Siswa</th>
                <th width="20%">Nama Lengkap<br>No Telp</th>
                <th width="20%">Alamat</th>
                <th width="10%">Tempat / Tanggal Lahir</th>
                <th width="15%"></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($results as $val) : ?>
                  <tr>
                    <td><?=$no++?></td>
                    <td> <?=$val['username']?> - <?=$val['email']?></td>
                    <td> <?=$val['nisn']?></td>
                    <td>
                      <?php 
                        if($val['is_active'] ==1){
                          echo '<label class="label label-success">Aktif</label>';
                        }else{
                          echo '<label class="label label-warning">Tidak Aktif</label>';
                        }
                      ?>
                    </td>
                    <td>
                      <?php 
                        if($val['status'] ==1){
                          echo '<label class="label label-success">Siswa Aktif</label>';
                        }else{
                          echo '<label class="label label-warning">Alumni</label>';
                        }
                      ?>
                    </td>
                    <td><?=$val['name']?> - <?=$val['student_phone']?></td>
                    <td><?=$val['alamat']?></td>
                    <td>
                      <?=$val['tempat_lahir']?> - <?=$val['tanggal_lahir']?>
                    </td>
                    <td>
                       <a href="<?= base_url(); ?>member/member/edit_member/<?= encrypt_url($val['id']) ?>" class="btn btn-warning btn-mini" data-toggle="modal">
                          <i class="fa fa-pencil"></i>
                      </a>
                      <a onclick="deleteConfirm(' <?= base_url(); ?>member/member/delete_process/<?= encrypt_url($val['id']) ?>')" href="#!" class="btn btn-mini btn-danger">
                          <i class="fa fa-trash"></i>
                      </a>
                    </td>
                  </tr>     
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>  
        <nav aria-label="Page navigation example">
          <?=$links?>
        </nav>
      </div>
    </div>
  </div>
</div>
<!-- load modal here -->
<?php $this->load->view('backend/member/member/modals'); ?>
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

