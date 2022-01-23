<link href="<?= base_url('assets/plugins/'); ?>datatables/datatables.min.css" rel="stylesheet">
<!-- Breadcumb positiion -->
<ul class="breadcrumb">
  <li>
    <p>Member</p>
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
        <br>
        <br>
        <div class="table-responsive">
          <table id="list_table" class="table table-bordered">
            <thead>
              <tr>
                <th width="5%">No</th>
                <th width="15%">Username / E-Mail</th>
                <th width="15%">NISN</th>
                <th width="15%">Nama Lengkap<br>No Telp</th>
                <th width="10%">Alamat</th>
                <th width="20%">Tempat / Tgl Lahir</th>
               <th width="20%"></th>
              </tr>
            </thead>
            <tbody>
              <?php 
                $no = 1;
                foreach ($results as $val) : 
              ?>
                  <tr>
                    <td><?=$no++?></td>
                    <td><?=$val['username']?> - <?=$val['email']?></td>
                    <td><?=$val['nisn']?></td>
                    <td><?=$val['name']?> - <?=$val['student_phone']?></td>
                    <td><?=$val['alamat']?></td>
                    <td><?=$val['tempat_lahir']?> / <?=$val['tanggal_lahir']?></td>
                    <td>
                      <a onclick="approveConfirm(' <?= base_url(); ?>member/approve/approve_process/<?= encrypt_url($val['id']) ?>')" href="#!" class="btn btn-mini btn-primary">
                          <i class="fa fa-check-circle"> Setujui</i>
                      </a>
                      <a onclick="declineConfirm(' <?= base_url(); ?>member/approve/decline_process/<?= encrypt_url($val['id']) ?>')" href="#!" class="btn btn-mini btn-danger">
                          <i class="fa fa-times"> Tolak</i>
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
</div>

<!-- Modal Delete -->
<div class="modal fade" id="approveModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">Apa anda yakin menyetujui registrasi ini ?</div>
            <div class="modal-footer">
                <a id="btn-delete" class="btn btn-primary" href="#">Setujui</a>
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="declineModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">Apa anda yakin menolak registrasi ini ?</div>
            <div class="modal-footer">
                <a id="btn-decline" class="btn btn-danger" href="#">Tolak</a>
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" charset="utf8" src="<?= base_url('assets/plugins/'); ?>datatables/datatables.js"></script>
<!-- java script start here -->
<script>
    function approveConfirm(url) {
        $('#btn-delete').attr('href', url);
        $('#approveModal').modal();
    }

    function declineConfirm(url) {
        $('#btn-decline').attr('href', url);
        $('#declineModal').modal();
    }

    $(document).ready( function () {
        $('#list_table').DataTable();
    } );
</script>

