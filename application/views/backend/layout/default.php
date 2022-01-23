<?php
$this->load->view('backend/layout/header');
$this->load->view('backend/layout/topbar');
$this->load->view('backend/layout/sidebar');
?>
<div class="content">
<?php echo $contents;?>
</div>
<?php $this->load->view('backend/layout/footer');
