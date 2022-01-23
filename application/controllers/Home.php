<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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

	public function __construct()
    {
        parent::__construct();
        $this->load->model('PublicModel');
        $this->load->model('PostModel');
        $this->load->model('GlobalModel');
        $this->load->helper('text');
    	$this->init();
    }

    private function init(){
    	$this->data['user'] = $this->PublicModel->get_user_session_data();
        $this->data['app_setting'] = $this->PublicModel->get_app_setting();
        $this->data['app_info'] = $this->PublicModel->get_app_social();
        $this->data['pagination_config'] = $this->PublicModel->pagination_config();
        // $this->data['notification'] = $this->PublicModel->get_notification();
    }


	public function index()
	{
		$data = $this->data;
		$data['title'] = '';
		// get other data
		$data['slider'] = $this->PostModel->getAllGaleriHome();
		$data['last_blog'] = $this->PostModel->getLastPostLimit();
		$data['banner']    = $this->GlobalModel->getAppBanner();
		$data['blog'] = $this->PostModel->getAllPostLimit([$data['last_blog']['id'],2]);
		
		$this->public_template->load('default', 'contents', 'frontend/home/index.php', $data);
	}
}
