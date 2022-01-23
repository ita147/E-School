<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends Base_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel');
        $this->load->model('GlobalModel');
    }

	public function index()
	{
		$data = $this->data;
		$data['title']      = "API's Setting";
		// get all users
		$data['users']		= $this->UserModel->getAllUser();
		$data['results']	= $this->GlobalModel->getAppApi();
        
        // set template yang kan digunakan ke view
        $this->template->load('default', 'contents', 'backend/setting/api/index.php', $data);
	}


	// save process
	public function save_process()
    {
    	// validation form
        $this->form_validation->set_rules('onesignal_app_id', 'OneSignal APP ID', 'trim');
        $this->form_validation->set_rules('onesignal_rest_api', 'OneSignal Rest API', 'trim');
        $this->form_validation->set_rules('onesignal_safari', 'OneSignal Safari ID', 'trim');
        $this->form_validation->set_rules('rajaongkir_key', 'Raja Ongkir API Key', 'trim');
        $this->form_validation->set_rules('rajaongkir_url', 'Raja Ongkir API URL', 'trim');
        $this->form_validation->set_rules('mailsender_address', 'Mail Sender Address', 'trim');
        $this->form_validation->set_rules('mailsender_password', 'Mail Sender Password', 'trim');
        // validation checking
        if ($this->form_validation->run() == false) {
        	$this->session->set_flashdata('error', validation_errors());
            redirect('setting/api');
        } else {
        	// set data for post
        	$data = [
                "mailsender_address"    => $this->input->post('mailsender_address', true),
                "mailsender_password"   => $this->input->post('mailsender_password', true),
	            'updated_by'	        => $this->data['user']['id']
	        ];

        	// call model
            if ($this->GlobalModel->updateItem($data,['id' => 1],'app_api')) {
            	$this->session->set_flashdata('success', 'Data API berhasil di simpan !');	
            }else{
            	$this->session->set_flashdata('error', 'Data API gagal berhasil di simpan !');	
            }
            redirect('setting/api');
        }
    }

}
