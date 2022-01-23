<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registrasi extends CI_Controller {

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
        $this->load->model('UserModel');
        $this->load->model('MasterModel');
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
        if (!empty($this->session->userdata('username'))) {
            $this->session->set_flashdata('error', 'Anda Sudah Login');  
            redirect('/');
        }
    }

    
    public function index()
    {
    	$data = $this->data;
        $data['title']    = 'Registrasi';
        // get other data
        $data['slider'] = $this->PostModel->getAllGaleriHome();
        // set view
        $this->public_template->load('default', 'contents', 'frontend/pages/registrasi.php', $data);
    }

    // add process
    public function save_process()
    {
        // validation form
        $this->form_validation->set_rules('name', 'Nama', 'trim|required');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'trim|required');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'trim|required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
        $this->form_validation->set_rules('student_phone', 'No Handphone', 'trim|required');
         $this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[user.email]');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[user.username]');
        $this->form_validation->set_rules('nisn', 'NISN', 'trim|required|is_unique[user_member.nisn]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
     
        // validation checking
        if ($this->form_validation->run() == FALSE)
        {
            $data = $this->data;
            $data['title']      = 'Registrasi';
            // get data
            $this->session->set_flashdata('error', validation_errors());
            $this->public_template->load('default', 'contents', 'frontend/pages/registrasi.php', $data);  
        } else {
            try {
                // set data for post
                $data = [
                    "name"      => $this->input->post('name', true),
                    "username"  => $this->input->post('username', true),
                    "email"  => $this->input->post('email', true),
                    "password"  => md5($this->input->post('password', true)),
                    "is_active" => 0,
                    "role_id"   => 4,
                ];
               
                // call model
                if ($this->GlobalModel->addItem($data, 'user')) {
                    $user_id = $this->GlobalModel->lastID();
                    // set data for detail pengajar
                    $data = [
                        'nisn'  => $this->input->post('nisn', true),
                        'tempat_lahir'  => $this->input->post('tempat_lahir', true),
                        'tanggal_lahir' => $this->input->post('tanggal_lahir', true),
                        'alamat'        => $this->input->post('alamat', true),
                        'student_phone' => $this->input->post('student_phone', true),
                        'status'        => 2,
                        'user_id'       => $user_id
                    ];
                    $this->GlobalModel->addItem($data, 'user_member');
                    $this->session->set_flashdata('success', 'Registrasi berhasil!, Administrator akan segera mengaktifkan akun !');  
                    redirect('/login','refresh');  
                }else{
                    $this->session->set_flashdata('error', 'Registrasi gagal !'); 
                    redirect('registrasi','refresh');
                }
                
            } catch (Exception $e) {
                $data = $this->data;
                $data['title']      = 'Registrasi';
                // get data
                $this->session->set_flashdata('error', 'Registrasi gagal !');
                $this->public_template->load('default', 'contents', 'frontend/pages/registrasi.php', $data);   
            }
            
        }
    }

    public function lupa_password()
    {
        $data = $this->data;
        // get other data
        $data['slider'] = $this->PostModel->getAllGaleriHome();
        $data['title']    = 'Lupa Password';
        // load view
        $this->public_template->load('default', 'contents', 'frontend/pages/lupa_password.php', $data);

    }

    public function reset_process()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        // validation checking
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('error', validation_errors()); 
            redirect('lupa-password','refresh'); 
        } else {
            // check username
            $user = $this->UserModel->getUserByMail($this->input->post('email'));
            if (empty($user)) {
                $this->session->set_flashdata('error', 'Email Tidak Di Temukan !!'); 
                redirect('lupa-password','refresh'); 
            }else{
                // send mail
                $key = encrypt_url($user['email'].'_'.date('Y-m-d'));
                $view['key']     = str_replace('=', '', $key);
                $view['name']    = $user['name'];
                $view['setting'] = $this->GlobalModel->getAppSettings();
                $view['contact'] = $this->GlobalModel->getAppSocial();
                $html = $this->load->view('email/reset_notification', $view, true);
                // sent notification
                $this->load->helper('notification');
                if (send_notification($user['email'], 'Reset Password', $html) == false) {
                    $this->session->set_flashdata('error', 'Email Gagal Terkirim !!'); 
                    redirect('lupa-password','refresh'); 
                }else{
                    $this->session->set_flashdata('success', 'Tautan Reset Password Sudah Kami Kirim Ke Email Anda !!'); 
                    redirect('lupa-password','refresh');  
                }
            }
            
        }
    }


    public function reset_password($key)
    {
        $real_key = decrypt_url($key);
        // get detail user by explode
        $explode = explode('_', $real_key);
        if (date('Y-m-d') != $explode[1]) {
            $this->session->set_flashdata('error', 'URL Telah Kadaluarsa !!');
            redirect('lupa-password','refresh');
        }
        // check user
        $user = $this->UserModel->getUserByMail($explode[0]);
        // update user by
        if (empty($user)) {
            $this->session->set_flashdata('error', 'URL Telah Kadaluarsa !!');
            redirect('lupa-password','refresh');  
        }else{
            $data = $this->data;
            $data['title']    = 'Reset Password';
            $data['keys']     = $key;
            // load view
            // get other data
            $data['slider'] = $this->PostModel->getAllGaleriHome();
            $this->public_template->load('default', 'contents', 'frontend/pages/reset_password.php', $data);

        }
    }

    public function change_password()
    {
        $key      = $this->input->post('key');
        $password = $this->input->post('password');
        $real_key = decrypt_url($key);
        // get detail user by explode
        $explode = explode('_', $real_key);

        if (empty($key)) {
            $this->session->set_flashdata('error', 'URL Telah Kadaluarsa !!');
            redirect('lupa-password','refresh');
        }else{
            $data = ["password" => md5($this->input->post('password', true))];   
            // where
            $user = $this->UserModel->getUserByMail($explode[0]);
            $where = ["id" => $user['id']];   
            if ($this->GlobalModel->updateItem($data, $where, 'user')) {
                $this->session->set_flashdata('success', 'Password Berhasil Diperbarui !!');
                redirect('/login','refresh');
            }else{
                $this->session->set_flashdata('error', 'Password Gagal Diperbarui !!');
                redirect('reset-password/'.$this->input->post('key'),'refresh');
            }
        }
    }

  

  


}
