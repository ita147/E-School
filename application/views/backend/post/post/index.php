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
  <div class="col-md-12">
    <div class="grid simple ">
      <div class="grid-title no-border">
      </div>
      <div class="grid-body no-border">
        <!-- load form notfication here -->
        <?php $this->load->view('backend/layout/form_notification'); ?>
        <!-- start listing data here -->
        <div class="row">
          <form action="<?= base_url('post/post/search_process'); ?>" method="post">
            <div class="col-md-3 col-sm-12" style="padding-top: 10px;">
              <input type="text" class="form-control" name="titles" placeholder="Judul" value="<?=$titles?>">
            </div>
            <div class="col-md-3 col-sm-12" style="padding-top: 10px;">
                <select class="form-control select2" name="categories" placeholder="--Pilih Kategori--">
                  <option></option>
                  <?php foreach ($categories as $val) : ?>
                    <option value="<?=$val['id']?>" <?php echo ($categories_sel == $val['id'] ? 'selected="selected"'  : ''); ?>><?=$val['name']?></option>
                  <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-6 col-sm-12" style="padding-top: 10px;">
              <button type="submit" class="btn btn-default" value="show" name="submit"><i class="fa fa-search"></i> Tampil</button>
              <button type="submit" class="btn btn-danger" value="reset" name="submit"><i class="fa fa-circle"></i>  Reset</button>
              <a class="btn btn-success" href="<?= base_url(); ?>post/post/add_post">
              <i class="fa fa-plus"></i> Tambah Post </a>
            </div>
          </form>
        </div>
        
        <br>
        <br>
        <div class="table-responsive">
        <table class="table table-bordered" >
          <thead>
            <tr>
              <th>No</th>
              <th>Judul</th>
              <th>Kategori</th>
              <th>Tags</th>
              <th>Publish</th>
              <th>Created at</th>
              <th>Created by</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
              <?php foreach ($results as $val) : ?>
                <tr>
                  <td><?=$no++?></td>
                  <td><?=$val['title']?></td>
                  <td>
                    <?php foreach ($val['categories'] as $cat) : 
                          echo '<label class="label label-default">'.$cat['name'].'</label>&nbsp;';
                          endforeach;
                    ?>
                  </td>
                  <td>
                    <?php foreach ($val['tags'] as $tag) : 
                          echo '<label class="label label-default">'.$tag['name'].'</label>&nbsp;';
                          endforeach;
                    ?>
                  </td>
                  <td>
                    <?php 
                      if($val['is_publish'] ==1){
                        echo '<label class="label label-success">Public</label>';
                      }else{
                        echo '<label class="label label-warning">Draft</label>';
                      }
                    ?>
                  </td>
                  <td><?=$val['created_at']?></td>
                  <td><?=$val['name']?></td>
                  <td>
                    <a href="<?= base_url(); ?>post/post/edit_post/<?= encrypt_url($val['id']) ?>" class="btn btn-warning btn-mini" data-toggle="modal">
                        <li class="fa fa-pencil"></li>
                    </a>
                    <a onclick="deleteConfirm(' <?= base_url(); ?>post/post/delete_process/<?= encrypt_url($val['id']) ?>')" href="#!" class="btn btn-mini btn-danger">
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
<?php $this->load->view('backend/post/post/modals'); ?>
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

