<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sejarah extends Base_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel');
        $this->load->model('GlobalModel');
    }

	public function index()
	{
		$data = $this->data;
		$data['title']      = 'Sejarah';
		// get all users
		$data['users']		= $this->UserModel->getAllUser();
		$data['results']	= $this->GlobalModel->getAppPages();
        // set template yang kan digunakan ke view
        $this->template->load('default', 'contents', 'backend/pages/sejarah.php', $data);
	}

	// save process
	public function save_process()
    {
    	// validation form
        $this->form_validation->set_rules('history', 'Sejarah', 'required');
        // validation checking
        if ($this->form_validation->run() == false) {
        	$this->session->set_flashdata('error', validation_errors());
            redirect('pages/sejarah');
        } else {
        	// set data for post
        	$data = [
	            "history" 		    => $this->input->post('history'),
	            'updated_by'		=> $this->data['user']['id']
	        ];
        	// call model
            if ($this->GlobalModel->updateItem($data,['id' => 1],'app_pages')) {
            	$this->session->set_flashdata('success', 'Sejarah berhasil di simpan !');	
            }else{
            	$this->session->set_flashdata('error', 'Sejarah gagal di simpan !');	
            }
            redirect('pages/sejarah');
        }
    }

}
