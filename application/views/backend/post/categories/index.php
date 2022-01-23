<!-- Breadcumb positiion -->
<ul class="breadcrumb">
  <li>
    <p>Post</p>
  </li>
  <li><a href="#" class="active"><?=$title?></a>
  </li>
</ul>
<!-- Heading Of Page -->
<div class="page-title"> <i class="fa fa-book"></i>
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
          <a data-toggle="modal" data-target="#newModal" class="btn btn-success btn-mini" data-toggle="modal" >
            <i class="fa fa-plus"></i> Tambah Kategori </a>
        </div>
        <br>
        <br>
        <div class="table-responsive">
          <table class="table table-bordered" >
            <thead>
              <tr>
                <th width="5%">No</th>
                <th width="40%">Kategori</th>
                <th width="40%">Slug</th>
                <th width="15%"></th>
              </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $val) : ?>
                  <tr>
                    <td><?=$no++?></td>
                    <td><?=$val['name']?></td>
                    <td><?=$val['slug']?></td>
                    <td>
                      <a data-toggle="modal" data-target="#editModal<?php echo $val['id'] ?>" class="btn btn-warning btn-mini" data-toggle="modal">
                          <li class="fa fa-pencil"></li>
                      </a>
                      <a onclick="deleteConfirm(' <?= base_url(); ?>post/categories/delete_process/<?= encrypt_url($val['id']) ?>')" href="#!" class="btn btn-mini btn-danger">
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
                            <h4 id="myModalLabel" class="semi-bold">Edit Kategori.</h4>
                          </div>
                          <form action="<?= base_url('post/categories/edit_process'); ?>" method="post">
                            <input type="hidden" name="id" value="<?=$val['id']?>">
                            <div class="modal-body">
                              <div class="row form-row">
                                <div class="col-md-12">
                                  <div class="form-group row">
                                    <label for="inputMenu" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" id="inputMenu" placeholder="Name" name="name" style="width: 250px;" value="<?=$val['name']?>">
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
        <nav aria-label="Page navigation example">
          <?=$links?>
        </nav>
      </div>
    </div>
  </div>
</div>
<!-- load modal here -->
<?php $this->load->view('backend/post/categories/modals'); ?>
<!-- java script start here -->
<script>
    function deleteConfirm(url) {
        $('#btn-delete').attr('href', url);
        $('#deleteModal').modal();
    }
</script>

