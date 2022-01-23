<!-- Breadcumb positiion -->
<ul class="breadcrumb">
  <li>
    <p>Homepage Setting</p>
  </li>
  <li><a href="#" class="active"><?=$title?></a>
  </li>
</ul>
<!-- Heading Of Page -->
<div class="page-title"> <i class="fa fa-globe"></i>
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
          <a class="btn btn-success" href="<?= base_url(); ?>homepage/galeri/add_galeri">
              <i class="fa fa-plus"></i> Tambah Galeri </a>
        </div>
        <br>
        <br>
        <hr>
        <br>
        <br>
        <div class="table-responsive">
          <table class="table table-bordered" >
            <thead>
              <tr>
                <th width="5%">No</th>
                <th width="20%">Judul</th>
                <th width="20%">Image</th>
                <th width="20%">Deskripsi</th>
                <th width="15%"></th>
              </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $val) : ?>
                  <tr>
                    <td><?=$no++?></td>           
                    <td><?=$val['title']?></td>
                    <td>
                      <object type="image" data="<?= base_url('assets/')?>img/default.jpg">
                        <img src="<?= resize_image(320 , $val['image'])?>" style="width: 100%">
                      </object>
                    </td>
                    <td><?=$val['description']?></td>
                    <td>
                      <a class="btn btn-warning btn-mini" href="<?= base_url(); ?>homepage/galeri/edit_galeri/<?= encrypt_url($val['id'])?>">
                          <li class="fa fa-pencil"></li>
                      </a>
                      <a onclick="deleteConfirm(' <?= base_url(); ?>homepage/galeri/delete_process/<?= encrypt_url($val['id']) ?>')" href="#!" class="btn btn-mini btn-danger">
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
<?php $this->load->view('backend/homepage/galeri/modals'); ?>
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

