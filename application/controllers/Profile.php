<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends Base_Controller {

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
        // load model here
        $this->load->model('GlobalModel');    
    }

   
    
    public function index()
    {
    	$data = $this->data;
        $data['detail'] = $this->UserModel->get_detail_users_by_id($this->session->userdata('user_id'));
        $data['title']    = 'Profile';
        // set view
        $this->template->load('default', 'contents', 'backend/user/profile.php', $data);   
    }

    // edit process
    public function save_process()
    {
        // validation form
        $this->form_validation->set_rules('id', 'ID', 'required');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('image', 'Foto', 'trim');
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error', validation_errors());
            if (empty(decrypt_url($this->input->post('id')))) {
                redirect('profile');
            }
        } else {
            try {
                // validation checking
                $id = decrypt_url($this->input->post('id'));
                // check email and user name
                $check_user = $this->UserModel->checkusernameEdit($id, $this->input->post('username', true));
                $check_email = $this->UserModel->checkemailEdit($id, $this->input->post('email', true));
                if (!$check_email || !$check_user) {
                    $this->session->set_flashdata('error', 'Username/Email Sudah Digunakan');
                    redirect('profile');
                }
                       
                $update_res = [
                    "name"      => $this->input->post('name', true),
                    "username"  => $this->input->post('username', true),
                    "image"     => $this->input->post('image', true),
                    "email"     => $this->input->post('email', true)
                ];
        
                // set data for post
                if (!empty($this->input->post('password'))) {
                    $update_res['password'] = md5($this->input->post('password'));  
                }
                
                $where = ['id' => $id];              
                // call model
                if ($this->GlobalModel->updateItem($update_res, $where, 'user')) {
                    $this->session->set_flashdata('success', 'Profile berhasil di simpan !');    
                }else{
                    $this->session->set_flashdata('error', 'Profile gagal di simpan !'); 
                }
                // redirect 
                redirect('profile');
            } catch (Exception $e) {
                $this->session->set_flashdata('error', 'Data Pengajar gagal di simpan !'); 
                redirect('profile');
            }
            
        }
    }


      // edit process
    public function save_process_member()
    {
        // validation form
        $this->form_validation->set_rules('id', 'ID', 'required');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('image', 'Foto', 'trim');
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error', validation_errors());
            if (empty(decrypt_url($this->input->post('id')))) {
                redirect('profile');
            }
        } else {
            try {
                // validation checking
                $id = decrypt_url($this->input->post('id'));
                // check email and user name
                $check_user = $this->UserModel->checkusernameEdit($id, $this->input->post('username', true));
                $check_email = $this->UserModel->checkemailEdit($id, $this->input->post('email', true));
                if (!$check_email || !$check_user) {
                    $this->session->set_flashdata('error', 'Username/Email Sudah Digunakan');
                    redirect('profile');
                }

                // check file 
                $config['upload_path'] = './upload/profile';
                $config['allowed_types'] = 'jpeg|jpg|png';
                $config['max_size'] = 10240;

                // load library
                $this->load->library('upload', $config);

                if (!empty($_FILES['image']['name'])) {
                    if (!$this->upload->do_upload('image')) {
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                        redirect('profile');
                    } else {
                        $data = $this->upload->data();
                        $update_res = [
                            "name"      => $this->input->post('name', true),
                            "username"  => $this->input->post('username', true),
                            "image"     => 'profile/'.$data['file_name'],
                            "email"     => $this->input->post('email', true)
                        ];
                    }
                } else {
                    $update_res = [
                        "name"      => $this->input->post('name', true),
                        "username"  => $this->input->post('username', true),
                        "email"     => $this->input->post('email', true)
                    ];
                }
                // set data for post
                if (!empty($this->input->post('password'))) {
                    $update_res['password'] = md5($this->input->post('password'));  
                }
                
                $where = ['id' => $id];              
                // call model
                if ($this->GlobalModel->updateItem($update_res, $where, 'user')) {
                    $this->session->set_flashdata('success', 'Profile berhasil di simpan !');    
                }else{
                    $this->session->set_flashdata('error', 'Profile gagal di simpan !'); 
                }
                // redirect 
                redirect('profile');
            } catch (Exception $e) {
                $this->session->set_flashdata('error', 'Profile gagal di simpan !'); 
                redirect('profile');
            }
            
        }
    }

  


}
