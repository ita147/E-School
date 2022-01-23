<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role_access extends Base_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('RoleModel');
        $this->load->model('GlobalModel');
    }

	public function index()
	{
		$data = $this->data;
		$data['title']      = 'Access';
        // get search data
        $search = $this->session->userdata('access_search');
        if ($search) {
            $data['role_id'] = $search;
        }else{
            $data['role_id'] = 1;
        }
		// get menus
		$data['results']    = $this->RoleModel->getAllAccess($data['role_id']);
        $data['role']       = $this->RoleModel->getAllRole();
        // set template yang kan digunakan ke view
        $this->template->load('default', 'contents', 'backend/setting/access/index.php', $data);
	}

	// add menu process
	public function save_process()
    {
    	// validation form
        $this->form_validation->set_rules('role_ids', 'Role', 'trim|required');
        // validation checking
        if ($this->form_validation->run() == false) {
        	$this->session->set_flashdata('error', validation_errors());
            redirect('setting/role_access');
        } else {
        	if ($this->input->post('submit', true) == 'show') {
                $role_ids = $this->input->post('role_ids', true);
                $this->session->set_userdata('access_search', $role_ids);
                redirect('setting/role_access');
            }else{
                $main_selected = $this->input->post('main_selected', true);
                $sub_selected = $this->input->post('sub_selected', true);
                $role_ids = $this->input->post('role_ids', true);
                $data_main = [];
                $data_sub = [];
                foreach ($main_selected as $key => $value) {
                    if ($value == 1) {
                        $data_main[] = [
                            'role_id'   => $role_ids,
                            'menu_id'   => $key,
                        ];  
                        if (!empty($sub_selected[$key])) {
                            foreach ($sub_selected[$key] as $keys => $val ) {
                                if ($val == 1) {
                                    $data_sub[] = [
                                        'role_id'       => $role_ids,
                                        'menu_id'       => $key,
                                        'sub_menu_id'   => $keys,
                                    ];     
                                }
                            }    
                        }
                    }
                }

                try {
                    // delete all associated role data
                    $where = ['role_id' => $role_ids];
                    $this->GlobalModel->deleteItem($where, 'user_access_menu');
                    // insert role
                    $this->GlobalModel->addItemBatch($data_main, 'user_access_menu');
                    $this->GlobalModel->addItemBatch($data_sub, 'user_access_menu');
                    $this->session->set_flashdata('success', 'Role berhasil di update !'); 
                    redirect('setting/role_access');  
                } catch (Exception $e) {
                    $this->session->set_flashdata('error', 'Akses gagal di update !');
                    redirect('setting/role_access');    
                }
            }
        }
    }

    
}
