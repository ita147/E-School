<?php
class Base_Controller extends CI_Controller {
	public $data = array();

    public function __construct() {
       	parent::__construct();
    	check_status_login();
    	$this->data['sidebar_menu'] = $this->get_backend_menu();
    	$this->data['user'] = $this->get_user_session_data();
        $this->data['app_setting'] = $this->get_app_setting();
        $this->data['pagination_config'] = $this->pagination_config();

    }

    private function get_user_session_data()
    {
    	$this->load->model('UserModel');
    	$user = $this->UserModel->get_detail_users_by_username($this->session->userdata('username'));
    	return $user;
    }

    private function get_backend_menu()
    {
    	$this->load->model('MenuModel');
    	$role_id = $this->session->userdata('role_id');
    	$menu = $this->MenuModel->get_menu_by_role($role_id);
    	return $menu;
    }

    private function get_app_setting()
    {
        $this->load->model('GlobalModel');
        return $this->GlobalModel->getAppSettings();
    }


    private function pagination_config(){
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] ="</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";

        return $config;
    }
}