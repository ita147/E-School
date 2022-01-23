<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class General extends Base_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel');
        $this->load->model('GlobalModel');
    }

	public function index()
	{
		$data = $this->data;
		$data['title']      = 'General Setting';
		// get all users
		$data['users']		= $this->UserModel->getAllUserSetting();
		$data['results']	= $this->GlobalModel->getAppSettings();
        // set template yang kan digunakan ke view
        $this->template->load('default', 'contents', 'backend/setting/general/index.php', $data);
	}

	// save process
	public function save_process()
    {
    	// validation form
        $this->form_validation->set_rules('site_title', 'Site Title', 'trim|required');
        $this->form_validation->set_rules('site_tagline', 'Site Tagline', 'trim');
        $this->form_validation->set_rules('mail_notification', 'Mail Notification', 'trim');
        $this->form_validation->set_rules('phone_notification', 'Phone Notification', 'trim');
        $this->form_validation->set_rules('mail_notification_list[]', 'Phone Notification', 'trim');
        $this->form_validation->set_rules('phone_notification_list[]', 'Phone Notification', 'trim');
        // validation checking
        if ($this->form_validation->run() == false) {
        	$this->session->set_flashdata('error', validation_errors());
            redirect('setting/general');
        } else {
        	// set data for post
        	$data = [
	            "site_title" 				=> $this->input->post('site_title', true),
	            "site_tagline" 				=> $this->input->post('site_tagline', true),
	            "mail_notification" 		=> ($this->input->post('mail_notification', true)) == NULL ? 0 : 1,
	            "phone_notification" 		=> ($this->input->post('phone_notification', true)) == NULL ? 0 : 1,
	            "mail_notification_list" 	=> serialize($this->input->post('mail_notification_list[]', true)),
	            "phone_notification_list" 	=> serialize($this->input->post('phone_notification_list[]', true)),
	            'updated_by'				=> $this->data['user']['id']
	        ];

        	// call model
            if ($this->GlobalModel->updateItem($data,['id' => 1],'app_setting')) {
            	$this->session->set_flashdata('success', 'Role baru berhasil di simpan !');	
            }else{
            	$this->session->set_flashdata('error', 'Role gagal berhasil di simpan !');	
            }
            redirect('setting/general');
        }
    }

}
