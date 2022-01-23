<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role extends Base_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('RoleModel');
        $this->load->model('GlobalModel');
    }

	public function index()
	{
		$data = $this->data;
		$data['title']      = 'Role';
		// get menus
		$data['results']	= $this->RoleModel->getAllRole();
        // set template yang kan digunakan ke view
        $this->template->load('default', 'contents', 'backend/setting/role/index.php', $data);
	}

	// add menu process
	public function add_process()
    {
    	// validation form
        $this->form_validation->set_rules('role', 'Role Name', 'trim|required');
        // validation checking
        if ($this->form_validation->run() == false) {
        	$this->session->set_flashdata('error', validation_errors());
            redirect('setting/role');
        } else {
        	// set data for post
        	$data = [
	            "role" => $this->input->post('role', true)
	        ];
        	// call model
            if ($this->GlobalModel->addItem($data, 'user_role')) {
            	$this->session->set_flashdata('success', 'Role baru berhasil di simpan !');	
            }else{
            	$this->session->set_flashdata('error', 'Role gagal di simpan !');	
            }
            redirect('setting/role');
        }
    }

    // edit menu process
    public function edit_process()
    {
    	// validation form
        $this->form_validation->set_rules('role', 'Role Name', 'trim|required');
        $this->form_validation->set_rules('id', 'Role ID', 'trim|required');
        // validation checking
        if ($this->form_validation->run() == false) {
        	$this->session->set_flashdata('error', validation_errors());
            redirect('setting/menu');
        } else {
        	// set data for post
        	$data = [
	            "role" => $this->input->post('role', true)
	        ];
	        // where item
	        $where = [
	            "id" => $this->input->post('id', true)
	        ];
        	// call model
            if ($this->GlobalModel->updateItem($data, $where, 'user_role')) {
            	$this->session->set_flashdata('success', 'Role berhasil di perbarui !');	
            }else{
            	$this->session->set_flashdata('error', 'Role gagal di perbarui !');	
            }
            redirect('setting/role');
        }
    }

    // delete process
    public function delete_process($id)
    {
    	// decripting parameters
    	$id = decrypt_url($id);
    	$where = ['id' => $id];
    	if ($this->GlobalModel->deleteItem($where, 'user_role')) {
        	$this->session->set_flashdata('success', 'Role berhasil di hapus !');	
        }else{
        	$this->session->set_flashdata('error', 'Role gagal di hapus !');	
        }
        redirect('setting/role');    	
    }
}
