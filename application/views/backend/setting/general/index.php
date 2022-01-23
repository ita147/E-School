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
        <form action="<?= base_url('setting/general/save_process'); ?>" method="post">
          <div class="row form-row">
            <div class="col-md-12">
              <div class="form-group row">
                <label for="inputTitle" class="col-sm-2 col-form-label">Site Title</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputTitle" placeholder="Title" name="site_title" style="width: 30%" value="<?=$results['site_title']?>">
                </div>
              </div>
              <div class="form-group row">
                <label for="inputTagline" class="col-sm-2 col-form-label">Tagline</label>
                <div class="col-sm-10">
                  <textarea name="site_tagline" class="form-control" style="width: 30%" rows="10" id="inputTagline"><?=$results['site_tagline']?></textarea>
                </div>
              </div>
              <div class="form-group row">
                <label  class="col-sm-2 col-form-label">Notification</label>
                <div class="col-sm-10">
                  <div class="row-fluid">
                    <div class="checkbox check-success ">
                      <input id="checkbox2" type="checkbox" value="1"  name="mail_notification" <?php echo ($results['mail_notification'] == 1) ?  'checked="checked"' : ''?>>
                      <label for="checkbox2">Mail</label>
                    </div>
                  </div>
                  <div class="row-fluid">
                    <div class="checkbox check-success  ">
                      <input id="checkbox1" type="checkbox" value="1"  name="phone_notification" <?php echo ($results['phone_notification'] == 1) ?  'checked="checked"' : ''?>>
                      <label for="checkbox1">Phone</label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label  class="col-sm-2 col-form-label">Mail Notification Person</label>
                <div class="col-sm-10">
                  <select class="select2" name="mail_notification_list[]" multiple style="width: 30%">
                    <?php foreach ($users as $val) : ?>
                      <option value="<?=$val['id']?>"  <?php echo (in_array($val['id'], $results['mail_notification_list'])) ?  'selected="selected"' : '' ?>><?=$val['name']?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
             <!--  <div class="form-group row">
                <label  class="col-sm-2 col-form-label">Phone Notification Person</label>
                <div class="col-sm-10">
                  <select class="select2" name="phone_notification_list[]" multiple style="width: 30%">
                    <?php foreach ($users as $val) : ?>
                      <option value="<?=$val['id']?>" <?php echo (in_array($val['id'], $results['phone_notification_list'])) ?  'selected="selected"' : '' ?>><?=$val['name']?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div> -->
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

