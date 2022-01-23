<?php
$error = $this->session->flashdata('error');
if ($error) {
    ?>
    <div class="alert alert-danger">
      <button class="close" data-dismiss="alert"><i class="fa fa-times"></i></button>
      <?php echo $error; ?>
    </div>
<?php }
$success = $this->session->flashdata('success');
if ($success) {
    ?>
    <div class="alert alert-success">
        <button class="close" data-dismiss="alert"><i class="fa fa-times"></i></button>
        <?php echo $success; ?>
    </div>
<?php } ?>