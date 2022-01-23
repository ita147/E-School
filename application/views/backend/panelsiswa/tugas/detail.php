


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
      </div>
      <div class="grid-body no-border">
        <!-- load form notfication here -->
        <?php $this->load->view('backend/layout/form_notification'); ?>
        <!-- start listing data here -->
        <div class="pull-right">
          <a class="btn btn-warning btn-mini" href="<?= base_url(); ?>panelsiswa/tugas">
            <i class="fa fa-arrow-left"></i> Kembali </a>
        </div>
        <br>
        <br>
        <hr>
        <!-- start listing data here -->
        <div class="form-group row">
          <label for="inputTitle" class="col-sm-2 col-form-label"><b>Judul</b></label>
          <div class="col-sm-10">
           <?=$results['title']?>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputTitle" class="col-sm-2 col-form-label"><b>Mapel</b></label>
          <div class="col-sm-10">
           <?=$results['categories_name']?>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputTitle" class="col-sm-2 col-form-label"><b>Deskripsi</b></label>
          <div class="col-sm-10">
           <?=$results['description']?>
          </div>
        </div>
      
        <?php if(!empty($results['file'])) { ?>
          <div class="form-group row">
            <label for="inputTitle" class="col-sm-2 col-form-label"><b></b></label>
            <div class="col-sm-10">
             <a class="btn btn-primary btn-mini" href="<?= base_url(); ?>panelsiswa/tugas/download/<?= encrypt_url($results['id']) ?>">
                <i class="fa fa-download"></i> Download File Tugas
            </a>
            </div>
          </div>
        <?php } ?>  
        <hr>
        <?php if (strtotime($results['max_upload']) >= strtotime(date('Y-m-d H:i:s'))) {?>
        <?php if (!empty($results['status_tugas'])) {?>
          <div class="form-group row">
            <label for="inputTitle" class="col-sm-2 col-form-label"><b>Status Upload</b></label>
            <div class="col-sm-10">
               <span class="label label-primary">Anda Sudah Upload Tugas</span>
            </div>
          </div>
        <?php  }else{?>
          <div class="form-group row">
            <label for="inputTitle" class="col-sm-2 col-form-label"><b>Upload</b></label>
            <div class="col-sm-10">
               <a data-toggle="modal" data-target="#newModal" class="btn btn-primary btn-mini" data-toggle="modal" >
              <i class="fa fa-upload"></i> Upload Tugas </a>
            </div>
          </div>
        <?php  }?>
      <?php  }else{?>
          <div class="form-group row">
            <label for="inputTitle" class="col-sm-2 col-form-label"><b>Status Upload</b></label>
            <div class="col-sm-10">
               <span class="label label-warning">Batas waktu upload habis !!</span>
            </div>
          </div>
      <?php  }?>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="newModal" tabindex="-1" role="dialog" aria-labelledby="newMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <br>
            <h4 id="myModalLabel" class="semi-bold">Upload Tugas.</h4>
          </div>
          <form action="<?= base_url('panelsiswa/tugas/upload_tugas_process'); ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="tugas_id" value="<?=$results['id']?>">
            <div class="modal-body">
              <div class="row form-row">
                <div class="form-group col-md-12">
                  <label for="exampleFormControlFile1">Upload file tugas disini. xlsx/doc/docx/jpg/pdf/png </label>
                  <input type="file" class="form-control-file" id="exampleFormControlFile1" accept=".doc, .docx, .ppt, .pptx, .xlsx, .xls, .pdf, .jpg, .png, .jpeg" required="required" name="file">
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
