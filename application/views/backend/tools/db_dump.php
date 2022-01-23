
<!-- Breadcumb positiion -->
<ul class="breadcrumb">
  <li>
    <p>Tools</p>
  </li>
  <li><a href="#" class="active">Mail Sender</a>
  </li>
</ul>
<!-- Heading Of Page -->
<div class="page-title"> <i class="fa fa-wrench"></i>
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
          <div class="col-md-12">
            <h5><b>Anda bisa melakukan backups database dengan tolbol di bawah ini!</b></h5>
            <br>
            <p style="color: red;">Pastikan koneksi internet anda stabil untuk melakukan backups database. backups meliputi full database dari sistem ini !</p>
            <br>
            <a class="btn btn-primary" href="<?= base_url('tools/dump/db_dump'); ?>"><i class="fa fa-download"></i> Backups / Download</a>
          </div>      
        </form>
      </div>
    </div>
  </div>
</div>

