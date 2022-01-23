<!-- Breadcumb positiion -->
<ul class="breadcrumb">
  <li>
    <p>Settings</p>
  </li>
  <li><a href="#" class="active">Role</a>
  </li>
</ul>
<!-- Heading Of Page -->
<div class="page-title"> <i class="fa fa-gear"></i>
  <h3><?=$title?></h3>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="grid simple ">
      <div class="grid-title no-border">
      </div>
      <div class="grid-body no-border">
        <!-- load form notfication here -->
        <?php $this->load->view('backend/layout/form_notification'); ?>
        <!-- start listing data here -->
        <div class="pull-right">
          <a data-toggle="modal" data-target="#newRoleModal" class="btn btn-success btn-mini" data-toggle="modal" >
            <i class="fa fa-plus"></i> Tambah Role </a>
        </div>
        <br>
        <br>
        <div class="table-responsive">
          <table class="table table-bordered" >
            <thead>
              <tr>
                <th width="5%">No</th>
                <th width="50%">Role Name</th>
                <th width="15%"></th>
              </tr>
            </thead>
            <tbody>
               <?php $i = 1; ?>
                <?php foreach ($results as $val) : ?>
                  <tr>
                    <td><?=$i++?></td>
                    <td><?=$val['role']?></td>
                    <td>
                      <a data-toggle="modal" data-target="#editModal<?php echo $val['id'] ?>" class="btn btn-warning btn-mini" data-toggle="modal">
                          <li class="fa fa-pencil"></li>
                      </a>
                      <a onclick="deleteConfirm(' <?= base_url(); ?>setting/role/delete_process/<?= encrypt_url($val['id']) ?>')" href="#!" class="btn btn-mini btn-danger">
                          <li class="fa fa-trash"></li>
                      </a>
                    </td>
                  </tr>     
                  <!-- Edit modals -->
                  <div class="modal fade" id="editModal<?php echo $val['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="newMenuModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <br>
                            <i class="fa fa-list fa-7x"></i>
                            <h4 id="myModalLabel" class="semi-bold">Edit Role.</h4>
                          </div>
                          <form action="<?= base_url('setting/role/edit_process'); ?>" method="post">
                            <input type="hidden" name="id" value="<?=$val['id']?>">
                            <div class="modal-body">
                              <div class="row form-row">
                                <div class="col-md-12">
                                  <div class="form-group row">
                                    <label for="inputMenu" class="col-sm-2 col-form-label">Role Name</label>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" id="inputMenu" placeholder="Role Name" name="role" style="width: 250px;" value="<?=$val['role']?>">
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                              <button class="btn btn-primary" type="submit">Simpan</button>
                            </div>
                          </form>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </tbody>
          </table>
        </div>   
      </div>
    </div>
  </div>
</div>
<!-- load modal here -->
<?php $this->load->view('backend/setting/role/modals'); ?>
<!-- java script start here -->
<script>
    function deleteConfirm(url) {
        $('#btn-delete').attr('href', url);
        $('#deleteModal').modal();
    }
</script>

