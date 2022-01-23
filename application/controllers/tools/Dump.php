<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dump extends Base_Controller
{

  public function __construct()
  {
      parent::__construct();
  }

  public function index()
  {
    $data = $this->data;
    $data['title']      = 'Database DUMP';
    // set template yang kan digunakan ke view
    $this->template->load('default', 'contents', 'backend/tools/db_dump.php', $data);
  }
   
  // backup database.sql
  public function db_dump()
  {
     $this->load->dbutil();
   
     $prefs = array(
       'format' => 'zip',
       'filename' => 'my_db_backup.sql'
     );
   
     $backup = $this->dbutil->backup($prefs);
   
     $db_name = 'backup-on-' . date("Y-m-d-H-i-s") . '.zip'; // file name
     $save  = 'backup/db/' . $db_name; // dir name backup output destination
   
     $this->load->helper('file');
     write_file($save, $backup);
   
     $this->load->helper('download');
     force_download($db_name, $backup);
  }
   
}