<!-- Breadcumb positiion -->
<ul class="breadcrumb">
  <li>
    <p>User</p>
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
        <div class="pull-right">
          <a class="btn btn-success btn-mini" href="<?= base_url(); ?>user/add_user">
            <i class="fa fa-plus"></i> Tambah User </a>
        </div>
        <br>
        <br>
        <div class="table-responsive">
          <table class="table table-bordered" >
            <thead>
              <tr>
                <th width="5%">No</th>
                <th width="15%">Username</th>
                <th width="10%">Status</th>
                <th width="20%">Nama Lengkap</th>
                <th width="15%"></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($results as $val) : ?>
                  <tr>
                    <td><?=$no++?></td>
                    <td><?=$val['username']?></td>
                    <td>
                      <?php 
                        if($val['is_active'] ==1){
                          echo '<label class="label label-success">Aktif</label>';
                        }else{
                          echo '<label class="label label-warning">Tidak Aktif</label>';
                        }
                      ?>
                    </td>
                    <td><?=$val['name']?></td>
                    <td>
                       <a href="<?= base_url(); ?>user/edit_user/<?= encrypt_url($val['id']) ?>" class="btn btn-warning btn-mini" data-toggle="modal">
                          <li class="fa fa-pencil"></li>
                      </a>
                      <a onclick="deleteConfirm(' <?= base_url(); ?>user/delete_process/<?= encrypt_url($val['id']) ?>')" href="#!" class="btn btn-mini btn-danger">
                          <li class="fa fa-trash"></li>
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
<?php $this->load->view('backend/master/categories/modals'); ?>
<!-- java script start here -->
<script>
    function deleteConfirm(url) {
        $('#btn-delete').attr('href', url);
        $('#deleteModal').modal();
    }
</script>

