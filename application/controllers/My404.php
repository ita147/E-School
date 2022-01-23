<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My404 extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$data['title'] = '404 Not Found';
		// // load user model
		// $this->load->model('UserModel');
  //   	$data['user'] = $this->UserModel->get_detail_users_by_username($this->session->userdata('username'));
  //   	$this->load->model('GlobalModel');
  //       $data['app_setting'] = $this->GlobalModel->getAppSettings();
  //   	// load sidebar
  //   	$this->load->model('MenuModel');
  //   	$role_id = $this->session->userdata('role_id');
  //   	$data['sidebar_menu'] = $this->MenuModel->get_menu_by_role($role_id);
    	// return to template
    	$this->load->view('backend/layout/404', $data, FALSE);
        // $this->template->load('default', 'contents', 'backend/layout/404', $data);
	}
}
