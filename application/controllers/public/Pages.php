<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

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
        $this->load->model('MasterModel');
        $this->load->model('DutyModel');
        $this->load->model('UserModel');
        $this->load->helper('text');
        $this->load->library('pagination');
    	$this->init();
    }

    private function init(){
    	$this->data['user'] = $this->PublicModel->get_user_session_data();
        $this->data['app_setting'] = $this->PublicModel->get_app_setting();
        $this->data['app_info'] = $this->PublicModel->get_app_social();
        $this->data['pagination_config'] = $this->PublicModel->pagination_config();
        // $this->data['notification'] = $this->PublicModel->get_notification();
    }

    

    
    public function history()
    {
        $data = $this->data;
        $data['results']    = $this->GlobalModel->getAppPages();
        $data['title']    = 'Sejarah';
        // set view
        $this->public_template->load('default', 'contents', 'frontend/pages/history.php', $data);   
    }

    
    public function visi()
    {
        $data = $this->data;
        $data['results']    = $this->GlobalModel->getAppPages();
        $data['title']    = 'Visi & Misi';
        // set view
        $this->public_template->load('default', 'contents', 'frontend/pages/visi.php', $data);   
    }

    public function galeri()
    {
        $data = $this->data;
        $data['results']    = $this->PostModel->getAllGaleriPost();
        $data['title']    = 'Galeri';
        // set view
        $this->public_template->load('default', 'contents', 'frontend/pages/gallery.php', $data);   
    }


}
