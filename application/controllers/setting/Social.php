<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Social extends Base_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel');
        $this->load->model('GlobalModel');
    }

	public function index()
	{
		$data = $this->data;
		$data['title']      = 'Sosial Media';
		// get all users
		$data['users']		= $this->UserModel->getAllUser();
		$data['results']	= $this->GlobalModel->getAppSocial();
        // set template yang kan digunakan ke view
        $this->template->load('default', 'contents', 'backend/setting/social/index.php', $data);
	}

	// save process
	public function save_process()
    {
    	// validation form
        $this->form_validation->set_rules('instagram', 'Instagram', 'trim');
        $this->form_validation->set_rules('facebook', 'Facebook', 'trim');
        $this->form_validation->set_rules('youtube', 'Youtube', 'trim');
        $this->form_validation->set_rules('whatapps', 'Whatapps', 'trim');
        $this->form_validation->set_rules('linkedin', 'LinkedIn', 'trim');
        $this->form_validation->set_rules('twitter', 'Twitter', 'trim');
        $this->form_validation->set_rules('gmail', 'Gmail', 'trim');
        $this->form_validation->set_rules('No_Telp', 'No_Telp', 'trim');
        $this->form_validation->set_rules('address', 'Alamat', 'trim');
        // validation checking
        if ($this->form_validation->run() == false) {
        	$this->session->set_flashdata('error', validation_errors());
            redirect('setting/social');
        } else {
        	// set data for post
        	$data = [
	            "instagram" 				=> $this->input->post('instagram'),
                "facebook"                  => $this->input->post('facebook'),
                "whatapps"                  => $this->input->post('whatapps'),
                "linkedin"                  => $this->input->post('linkedin'),
                "gmail"                     => $this->input->post('gmail'),
                "address"                   => $this->input->post('address'),
                "youtube"                   => $this->input->post('youtube'),
                "twitter"                   => $this->input->post('twitter'),
                "No_Telp"                   => $this->input->post('No_Telp')
	        ];

        	// call model
            if ($this->GlobalModel->updateItem($data,['id' => 1],'app_social')) {
            	$this->session->set_flashdata('success', 'Sosial Media berhasil di simpan !');	
            }else{
            	$this->session->set_flashdata('error', 'Sosial Media gagal di simpan !');	
            }
            redirect('setting/social');
        }
    }

}
