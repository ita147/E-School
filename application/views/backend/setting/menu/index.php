<!-- Breadcumb positiion -->
<ul class="breadcrumb">
  <li>
    <p>Settings</p>
  </li>
  <li><a href="#" class="active">Menu Settings</a>
  </li>
</ul>
<!-- Heading Of Page -->
<div class="page-title"> <i class="fa fa-gear"></i>
  <h3>Menu Management</h3>
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
          <a data-toggle="modal" data-target="#newMenuModal" class="btn btn-success btn-mini" data-toggle="modal" >
            <i class="fa fa-plus"></i> Tambah Menu </a>
        </div>
        <br>
        <br>
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th width="5%" class="text-center">No</th>
                <th width="5%" class="text-center"></th>
                <th width="50%">Menu</th>
                <th width="25%">Url</th>
                <th width="15%"></th>
              </tr>
            </thead>
            <tbody>
               <?php $i = 1; ?>
                <?php foreach ($results as $val) : ?>
                    <tr>
                        <td scope="row" class="text-center"><?= $i; ?></td>
                        <td class="text-center"><i class="<?= $val['icon']; ?>"></i></td>
                        <td><?= $val['menu']; ?></td>
                        <td><?= $val['url']; ?></td>
                        <td>
                            <a data-toggle="modal" data-target="#addSubMenuModal<?php echo $val['id'] ?>" class="btn btn-success btn-mini" data-toggle="modal">
                                <li class="fa fa-plus"></li>
                            </a>
                            <a data-toggle="modal" data-target="#editMenuModal<?php echo $val['id'] ?>" class="btn btn-warning btn-mini" data-toggle="modal">
                                <li class="fa fa-pencil"></li>
                            </a>
                            <a onclick="deleteConfirm(' <?= base_url(); ?>setting/menu/delete_process/<?= encrypt_url($val['id']) ?>')" href="#!" class="btn btn-mini btn-danger">
                                <li class="fa fa-trash"></li>
                            </a>
                        </td>
                        <?php $i++; ?>
                    </tr> 
                    <!-- Modal edit-->
                    <div class="modal fade" id="editMenuModal<?php echo $val['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="newMenuModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <br>
                                <h4 id="myModalLabel" class="semi-bold">Edit Menu</h4>
                              </div>
                              <form action="<?= base_url('setting/menu/edit_process'); ?>" method="post">
                                <input type="hidden" value="<?= $val['id']; ?>" name="id">
                                <div class="modal-body">
                                  <div class="row form-row">
                                    <div class="col-md-12">
                                      <div class="form-group row">
                                        <label for="inputMenu" class="col-sm-2 col-form-label">Menu</label>
                                        <div class="col-sm-10">
                                          <input type="text" class="form-control" id="inputMenu" placeholder="Menu" name="menu" style="width: 250px;" value="<?= $val['menu']; ?>">
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <label for="inputIcon" class="col-sm-2 col-form-label">Icon</label>
                                        <div class="col-sm-10">
                                          <input type="text" class="form-control" id="inputIcon" placeholder="Skrip Dari Font Awesome" style="width: 250px;" name="icon" value="<?= $val['icon']; ?>">
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <label for="inputUrl" class="col-sm-2 col-form-label">Url</label>
                                        <div class="col-sm-10">
                                          <input type="text" class="form-control" id="inputUrl" placeholder="System url" style="width: 250px;" name="url" value="<?= $val['url']; ?>">
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <label for="inputOrder" class="col-sm-2 col-form-label">Urutan Menu</label>
                                        <div class="col-sm-10">
                                          <input type="text" class="form-control" id="inputOrder" placeholder="sort" style="width: 100px;" name="order" value="<?= $val['order']; ?>">
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
                    <!-- add sub menu -->
                    <div class="modal fade" id="addSubMenuModal<?php echo $val['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="newMenuModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <br>
                                <h4 id="myModalLabel" class="semi-bold">Add Sub Menu</h4>
                              </div>
                              <form action="<?= base_url('setting/menu/add_sub_process'); ?>" method="post">
                                <input type="hidden" value="<?= $val['id']; ?>" name="menu_id">
                                <div class="modal-body">
                                  <div class="row form-row">
                                    <div class="col-md-12">
                                      <div class="form-group row">
                                        <label for="inputMenu" class="col-sm-2 col-form-label">Parent Menu</label>
                                        <div class="col-sm-10">
                                          <input type="text" class="form-control" id="inputMenu" placeholder="Menu" name="menu" style="width: 250px;" value="<?= $val['menu']; ?>" readonly>
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <label for="inputMenu" class="col-sm-2 col-form-label">Sub Menu</label>
                                        <div class="col-sm-10">
                                          <input type="text" class="form-control" id="inputMenu" placeholder="Menu" name="name" style="width: 250px;" value="">
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <label for="inputUrl" class="col-sm-2 col-form-label">Url</label>
                                        <div class="col-sm-10">
                                          <input type="text" class="form-control" id="inputUrl" placeholder="System url" style="width: 250px;" name="url" value="">
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <label for="inputOrder" class="col-sm-2 col-form-label">Urutan Menu</label>
                                        <div class="col-sm-10">
                                          <input type="text" class="form-control" id="inputOrder" placeholder="sort" style="width: 100px;" name="order" value="">
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

                    <!-- lopping sub menus -->
                    <?php foreach ($val['submenu'] as $res) : ?>
                    <tr>
                        <td scope="row"></td>
                        <td></td>
                        <td>----- <?= $res['name']; ?></td>
                        <td style="color : red;"><?= $val['url']; ?>/<?= $res['url']; ?></td>
                        <td>
                            <a data-toggle="modal" data-target="#editSubMenuModal<?php echo $res['id'] ?>" class="btn btn-warning btn-mini" data-toggle="modal">
                                <li class="fa fa-pencil"></li>
                            </a>
                            <a onclick="deleteConfirm(' <?= base_url(); ?>setting/menu/delete_sub_process/<?= encrypt_url($res['id']) ?>')" href="#!" class="btn btn-mini btn-danger">
                                <li class="fa fa-trash"></li>
                            </a>
                            <!-- Modal edit -->
                            <div class="modal fade" id="editSubMenuModal<?php echo $res['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="newMenuModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                      <br>
                                      <h4 id="myModalLabel" class="semi-bold">Edit Sub Menu</h4>
                                    </div>
                                    <form action="<?= base_url('setting/menu/edit_sub_process'); ?>" method="post">
                                      <input type="hidden" value="<?= $val['id']; ?>" name="menu_id">
                                      <input type="hidden" value="<?= $res['id']; ?>" name="id">
                                      <div class="modal-body">
                                        <div class="row form-row">
                                          <div class="col-md-12">
                                            <div class="form-group row">
                                              <label for="inputMenu" class="col-sm-2 col-form-label">Parent Menu</label>
                                              <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputMenu" placeholder="Menu" name="menu" style="width: 250px;" value="<?= $val['menu']; ?>" readonly>
                                              </div>
                                            </div>
                                            <div class="form-group row">
                                              <label for="inputMenu" class="col-sm-2 col-form-label">Sub Menu</label>
                                              <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputMenu" placeholder="Menu" name="name" style="width: 250px;" value="<?=$res['name']?>">
                                              </div>
                                            </div>
                                            <div class="form-group row">
                                              <label for="inputUrl" class="col-sm-2 col-form-label">Url</label>
                                              <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputUrl" placeholder="System url" style="width: 250px;" name="url" value="<?=$res['url']?>">
                                              </div>
                                            </div>
                                            <div class="form-group row">
                                              <label for="inputOrder" class="col-sm-2 col-form-label">Urutan Menu</label>
                                              <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputOrder" placeholder="sort" style="width: 100px;" name="order" value="<?=$res['order']?>">
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
                        </td>
                    </tr> 
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- load modal here -->
<?php $this->load->view('backend/setting/menu/modals'); ?>
<!-- java script start here -->
<script>
    function deleteConfirm(url) {
        $('#btn-delete').attr('href', url);
        $('#deleteModal').modal();
    }
</script>

