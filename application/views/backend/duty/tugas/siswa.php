<link href="<?= base_url('assets/plugins/'); ?>datatables/datatables.min.css" rel="stylesheet">
<!-- Breadcumb positiion -->
<ul class="breadcrumb">
  <li>
    <p>Tugas & Materi</p>
  </li>
  <li>
    <a href="#">Tugas</a>
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
        <h3><?=$detail['title']?> - Maksimal Upload : <?=$detail['max_upload']?></h3>
        <div class="pull-right">
          <a class="btn btn-warning btn-mini" href="<?= base_url(); ?>duty/tugas">
            <i class="fa fa-arrow-left"></i> Kembali </a>
        </div>
      </div>
      <div class="grid-body no-border">
        <!-- start listing data here -->
        <br>
        <br>
        <br>
        <table class="table table-bordered display responsive nowrap" style="width:100%"  id="list_table2">
          <thead>
            <tr>
              <th width="5%">No</th>
              <th width="10%">Di upload oleh</th>
              <th width="15%">Max. Upload</th>
              <th width="15%">Di upload pada</th>
              <th width="15%"></th>
            </tr>
          </thead>
          <tbody>
              <?php 
                $no = 1;
                foreach ($results as $val) : 
              ?>
                <tr>
                  <td><?=$no?></td>
                  <td>
                    <?=$val['creator']?><br>
                  </td>
                  <td><?=date('Y-m-d',strtotime($val['max_upload']))?></td>
                  <td><?=date('Y-m-d H:i:s',strtotime($val['created_at']))?></td>
                  <td>
                    <a  class="btn btn-success btn-sm" href="<?= base_url(); ?>duty/tugas/download_tugas_siswa/<?= encrypt_url($val['tugas_member_id']) ?>" target="blank">
                        <i class="fa fa-file-text"></i> Download
                      </a>
                  </td>
                </tr>     
              <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" charset="utf8" src="<?= base_url('assets/plugins/'); ?>datatables/datatables.js"></script>
<!-- java script start here -->
<script>
    $(document).ready( function () {
      $('#list_table2').DataTable( {
        responsive: true
      } );
    } );
</script>
<!--ABout US-->



