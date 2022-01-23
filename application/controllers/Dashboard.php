<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Base_Controller {

	public function __construct()
    {
        parent::__construct();
        // load library here
        $this->load->library('pagination');
    }

	public function index()
	{
		$data = $this->data;
		$data['title']      = 'Dashboard';
        // set template yang kan digunakan ke view
        $this->template->load('default', 'contents', 'backend/dashboard/index.php', $data);
	}
}
