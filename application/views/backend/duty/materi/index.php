<!-- Breadcumb positiion -->
<ul class="breadcrumb">
  <li>
    <p>Tugas & Materi</p>
  </li>
  <li><a href="#" class="active"><?=$title?></a>
  </li>
</ul>
<!-- Heading Of Page -->
<div class="page-title"> <i class="fa fa-archive"></i>
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
          <form action="<?= base_url('duty/materi/search_process'); ?>" method="post">
            <div class="col-md-3 col-sm-12" style="padding-top: 10px;">
              <input type="text" class="form-control" name="title_materi" placeholder="Judul Materi" value="<?= $title_materi ?>">
            </div>
            <div class="col-md-3 col-sm-12" style="padding-top: 10px;">
                <select class="form-control select2" name="categories_ids" placeholder="--Pilih Materi--">
                  <option></option>
                  <?php foreach ($categories as $res) : ?>
                    <option value="<?=$res['id']?>" <?php echo ($res['id'] == $categories_id ? 'selected="selected"'  : ''); ?>><?=$res['name']?></option>
                  <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-6 col-sm-12" style="padding-top: 10px;">
              <button type="submit" class="btn btn-default" value="show" name="submit"><i class="fa fa-search"></i> Tampil</button>
              <button type="submit" class="btn btn-danger" value="reset" name="submit"><i class="fa fa-circle"></i>  Reset</button>
              <a class="btn btn-success" href="<?= base_url(); ?>duty/materi/add_materi">
              <i class="fa fa-plus"></i> Tambah Materi </a>
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
                <th width="20%">Judul</th>
                <th width="10%">Kategori</th>
                <th width="10%">Tipe</th>
                <th width="20%">Uploader</th>
                <th width="15%"></th>
              </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $val) : ?>
                  <tr>
                    <td><?=$no++?></td>           
                    <td><?=$val['title']?></td>
                    <td><?=$val['categories_name']?></td>
                    <td><?=$val['type']?></td>
                    <td><?=$val['uploader']?></td>
                    <td>
                      <?php if($val['type'] == 'file'){ ?>
                          <a  class="btn btn-success btn-mini" href="<?= base_url(); ?>duty/materi/download/<?= encrypt_url($val['id']) ?>" target="blank">
                          <i class="fa fa-download"></i>
                      </a>
                      <?php }else{ ?>
                          <a  class="btn btn-success btn-mini" href="<?= base_url(); ?>duty/materi/download/<?= encrypt_url($val['id']) ?>" target="blank">
                          <i class="fa fa-file-video-o"></i>
                      </a>
                      <?php } ?>
         
                    
                      <a class="btn btn-warning btn-mini" href="<?= base_url(); ?>duty/materi/edit_materi/<?= encrypt_url($val['id']) ?>">
                          <i class="fa fa-pencil"></i>
                      </a>
                      <a onclick="deleteConfirm(' <?= base_url(); ?>duty/materi/delete_process/<?= encrypt_url($val['id']) ?>')" href="#!" class="btn btn-mini btn-danger">
                          <i class="fa fa-trash"></i>
                      </a>
                      <a class="btn btn-primary btn-mini" href="<?= base_url(); ?>duty/materi/detail_materi/<?= encrypt_url($val['id']) ?>">
                          <i class="fa fa-list"></i> Detail Materi
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
<?php $this->load->view('backend/duty/materi/modals'); ?>
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

