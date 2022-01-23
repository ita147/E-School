<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends Base_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('MenuModel');
        $this->load->model('GlobalModel');
    }

	public function index()
	{
		$data = $this->data;
		$data['title']      = 'Menu';
		// get menus
		$data['results']	= $this->MenuModel->getAllMenu();
        // set template yang kan digunakan ke view
        $this->template->load('default', 'contents', 'backend/setting/menu/index.php', $data);
	}

	// add menu process
	public function add_process()
    {
    	// validation form
        $this->form_validation->set_rules('menu', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'Url', 'required');
        $this->form_validation->set_rules('icon', 'icon', 'required');
        // validation checking
        if ($this->form_validation->run() == false) {
        	$this->session->set_flashdata('error', validation_errors());
            redirect('setting/menu');
        } else {
        	// set data for post
        	$data = [
	            "menu" => $this->input->post('menu', true),
	            "url" => $this->input->post('url', true),
	            "icon" => $this->input->post('icon', true),
	            "order" => $this->input->post('order', true)
	        ];
        	// call model
            if ($this->GlobalModel->addItem($data, 'app_menu')) {
            	$this->session->set_flashdata('success', 'Menu baru berhasil di simpan !');	
            }else{
            	$this->session->set_flashdata('error', 'Menu gagal di simpan !');	
            }
            redirect('setting/menu');
        }
    }

    // edit menu process
    public function edit_process()
    {
    	// validation form
        $this->form_validation->set_rules('id', 'Meny Id', 'required');
        $this->form_validation->set_rules('menu', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'Url', 'required');
        $this->form_validation->set_rules('icon', 'icon', 'required');
        // validation checking
        if ($this->form_validation->run() == false) {
        	$this->session->set_flashdata('error', validation_errors());
            redirect('setting/menu');
        } else {
        	// set data for post
        	$data = [
	            "menu" => $this->input->post('menu', true),
	            "url" => $this->input->post('url', true),
	            "icon" => $this->input->post('icon', true),
	            "order" => $this->input->post('order', true)
	        ];
	        // where item
	        $where = [
	            "id" => $this->input->post('id', true)
	        ];
        	// call model
            if ($this->GlobalModel->updateItem($data, $where, 'app_menu')) {
            	$this->session->set_flashdata('success', 'Menu baru berhasil di perbarui !');	
            }else{
            	$this->session->set_flashdata('error', 'Menu gagal di perbarui !');	
            }
            redirect('setting/menu');
        }
    }

    // delete process
    public function delete_process($id)
    {
    	// decripting parameters
    	$id = decrypt_url($id);
    	$where = ['id' => $id];
    	if ($this->GlobalModel->deleteItem($where, 'app_menu')) {
        	$this->session->set_flashdata('success', 'Menu berhasil di hapus !');	
        }else{
        	$this->session->set_flashdata('error', 'Menu gagal di hapus !');	
        }
        redirect('setting/menu');    	
    }

    // add sub menu process
    public function add_sub_process()
    {
    	// validation form
        $this->form_validation->set_rules('menu_id', 'Parent Menu', 'trim|required');
        $this->form_validation->set_rules('name', 'Menu', 'trim|required');
        $this->form_validation->set_rules('url', 'Url', 'trim|required');
        $this->form_validation->set_rules('order', 'Urutan Menu', 'trim|integer');
        // validation checking
        if ($this->form_validation->run() == false) {
        	$this->session->set_flashdata('error', validation_errors());
            redirect('setting/menu');
        } else {
        	// set data for post
        	$data = [
	            "name" => $this->input->post('name', true),
	            "url" => $this->input->post('url', true),
	            "order" => $this->input->post('order', true),
	            "menu_id" => $this->input->post('menu_id', true),
	            "is_active" => 1
	        ];
        	// call model
            if ($this->GlobalModel->addItem($data, 'app_sub_menu')) {
            	$this->session->set_flashdata('success', 'SubMenu baru berhasil di simpan !');	
            }else{
            	$this->session->set_flashdata('error', 'SubMenu gagal di simpan !');	
            }
            redirect('setting/menu');
        }
    }

    // edit sub menu process
    public function edit_sub_process()
    {
    	// validation form
        $this->form_validation->set_rules('id', 'Sub Id', 'required');
        $this->form_validation->set_rules('menu_id', 'Sub Menu Id', 'required');
        $this->form_validation->set_rules('menu', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'Url', 'required');
        $this->form_validation->set_rules('order', 'Order', 'required');
        // validation checking
        if ($this->form_validation->run() == false) {
        	$this->session->set_flashdata('error', validation_errors());
            redirect('setting/menu');
        } else {
        	// set data for post
        	$data = [
	            "menu_id" => $this->input->post('menu_id', true),
	            "name" => $this->input->post('name', true),
	            "url" => $this->input->post('url', true),
	            "order" => $this->input->post('order', true)
	        ];
	        // where item
	        $where = [
	            "id" => $this->input->post('id', true)
	        ];
        	// call model
            if ($this->GlobalModel->updateItem($data, $where, 'app_sub_menu')) {
            	$this->session->set_flashdata('success', 'SubMenu baru berhasil di perbarui !');	
            }else{
            	$this->session->set_flashdata('error', 'SubMenu gagal di perbarui !');	
            }
            redirect('setting/menu');
        }
    }

    // delete sub menu process
    public function delete_sub_process($id)
    {
    	// decripting parameters
    	$id = decrypt_url($id);
    	$where = ['id' => $id];
    	if ($this->GlobalModel->deleteItem($where, 'app_sub_menu')) {
        	$this->session->set_flashdata('success', 'SubMenu berhasil di hapus !');	
        }else{
        	$this->session->set_flashdata('error', 'SubMenu gagal di hapus !');	
        }
        redirect('setting/menu');    
    }


}
