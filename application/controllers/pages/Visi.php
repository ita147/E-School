<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Visi extends Base_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel');
        $this->load->model('GlobalModel');
    }

	public function index()
	{
		$data = $this->data;
		$data['title']      = 'Visi & Misi';
		// get all users
		$data['users']		= $this->UserModel->getAllUser();
		$data['results']	= $this->GlobalModel->getAppPages();
        // set template yang kan digunakan ke view
        $this->template->load('default', 'contents', 'backend/pages/visi.php', $data);
	}

	// save process
	public function save_process()
    {
    	// validation form
        $this->form_validation->set_rules('visi', 'Visi', 'required');
        // validation checking
        if ($this->form_validation->run() == false) {
        	$this->session->set_flashdata('error', validation_errors());
            redirect('pages/visi');
        } else {
        	// set data for post
        	$data = [
	            "visi" 				=> $this->input->post('visi'),
	            'updated_by'		=> $this->data['user']['id']
	        ];
        	// call model
            if ($this->GlobalModel->updateItem($data,['id' => 1],'app_pages')) {
            	$this->session->set_flashdata('success', 'Visi&Misi berhasil di simpan !');	
            }else{
            	$this->session->set_flashdata('error', 'Visi&Misi gagal di simpan !');	
            }
            redirect('pages/visi');
        }
    }

}
