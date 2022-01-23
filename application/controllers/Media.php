<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Media extends Base_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('PostModel');
        $this->load->model('GlobalModel');
        // load library here
        $this->load->library('pagination');
    }

	public function index()
	{
		$data = $this->data;
		$data['title']      = 'Media';
        // set template yang kan digunakan ke view
        $this->template->load('default', 'contents', 'backend/media/index.php', $data);
	}
}
