<!-- Breadcumb positiion -->
<ul class="breadcrumb">
  <li>
    <p>Media</p>
  </li>
  <li><a href="#" class="active"><?=$title?></a>
  </li>
</ul>
<!-- Heading Of Page -->
<div class="page-title"> <i class="fa fa-file-image-o"></i>
  <h3><?=$title?></h3>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="grid simple ">
      <div class="grid-title no-border">
      </div>
      <div class="grid-body no-border">
        <iframe  width="100%" height="550" frameborder="0"
          src="<?= base_url('includes/') ?>filemanager/dialog.php?type=0">
        </iframe>
        
      </div>
    </div>
  </div>
</div>
