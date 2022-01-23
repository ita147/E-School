<!-- Breadcumb positiion -->
<ul class="breadcrumb">
  <li>
    <p>Settings</p>
  </li>
  <li><a href="#" class="active">Role Access</a>
  </li>
</ul>
<!-- Heading Of Page -->
<div class="page-title"> <i class="fa fa-gear"></i>
  <h3>Role Access</h3>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="grid simple ">
      <div class="grid-title no-border">
      </div>
      <form action="<?= base_url('setting/role_access/save_process'); ?>" method="post">
        <div class="grid-body no-border">
          <!-- load form notfication here -->
          <?php $this->load->view('backend/layout/form_notification'); ?>
          <!-- start listing data here -->
          <div class="row">
            <div class="pull-left col-md-3">
                <select class="form-control" name="role_ids" >
                  <?php foreach ($role as $res) : ?>
                    <option value="<?=$res['id']?>" <?php echo ($res['id'] == $role_id ? 'selected="selected"'  : ''); ?>><?=$res['role']?></option>
                  <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2">
              <button type="submit" class="btn btn-default" value="show" name="submit"><i class="fa fa-search"></i> Tampil</button>
              <button type="submit" class="btn btn-success" value="save" name="submit"><i class="fa fa-save"></i>  Simpan</button>
            </div>
          </div>
          <br>
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th width="5%" class="text-center">No</th>
                  <th width="5%" class="text-center"></th>
                  <th width="50%">Menu</th>
                  <th width="25%">Url</th>
                </tr>
              </thead>
              <tbody>
                  <?php foreach ($results as $val) : ?>
                      <tr>
                          <td scope="row" class="text-center">
                            <div class="checkbox check-success  ">
                              <input id="checkbox<?=$val['id']?>" type="checkbox" value="1" <?php echo ($val['is_selected'] == 1 ? 'checked="checked"'  : ''); ?> name="main_selected[<?=$val['id']?>]">
                              <label for="checkbox<?=$val['id']?>"></label>
                            </div>
                          </td>
                          <td class="text-center"><i class="<?= $val['icon']; ?>"></i></td>
                          <td><?= $val['menu']; ?></td>
                          <td><?= $val['url']; ?></td>
                      </tr> 
                      <!-- lopping sub menus -->
                      <?php foreach ($val['submenu'] as $res) : ?>
                      <tr>
                          <td scope="row">
                            
                          </td>
                          <td class="text-center">
                            <div class="checkbox check-success  ">
                               <input id="checkboxsub<?=$res['id']?>" type="checkbox" value="1" <?php echo ($res['is_selected'] == 1 ? 'checked="checked"'  : ''); ?> name="sub_selected[<?=$val['id']?>][<?=$res['id']?>]">
                              <label for="checkboxsub<?=$res['id']?>"></label>
                            </div>
                          </td>
                          <td>----- <?= $res['name']; ?></td>
                          <td style="color : red;"><?= $val['url']; ?>/<?= $res['url']; ?></td>
                      </tr> 
                      <?php endforeach; ?>
                  <?php endforeach; ?>
              </tbody>
            </table>
          </div> 
        </div>
      </form>
    </div>
  </div>
</div>
