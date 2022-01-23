<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
               $this->load->model('PublicModel');
        $this->load->model('PostModel');
        $this->load->model('GlobalModel');
       $this->init();
    }

    private function init(){
        $this->data['app_setting'] = $this->PublicModel->get_app_setting();
        $this->data['app_info'] = $this->PublicModel->get_app_social();
        // $this->data['notification'] = $this->PublicModel->get_notification();
    }

    public function index()
    {
        // get cookie 
        $cookie = get_cookie('hellotech_bimbel');
        if ($this->session->userdata('username')) {
            if ($this->session->userdata('role_id') == 1 || $this->session->userdata('role_id') == 2 || $this->session->userdata('role_id') == 3) {
                redirect('dashboard');
            }else{
                redirect('profile');
            }
        }else if($cookie <> '') {
            // cek cookie
            $user = $this->db->get_where('user', ['cookie' => $cookie])->row_array();
            if ($user) {
                $data = [
                    'username' => $user['username'],
                    'user_id'  => $user['id'],
                    'role_id' => $user['role_id']

                ];
                $this->session->set_userdata($data);
                if ($user['role_id'] == 1 || $user['role_id'] == 2 || $user['role_id'] == 3) {
                    $this->session->set_userdata('file_manager',true);
                    redirect('dashboard');
                }else{
                    redirect('profile');
                }
            } else {
                delete_cookie('hellotech_eschool');
                $this->session->set_flashdata('error', 'Username atau password salah !!');
                redirect('login');
            }
        }

        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'User Login';
            if ($this->input->post('is_public')) {
                redirect('/');
            }else{
                $data = $this->data;
                $this->public_template->load('default', 'contents', 'frontend/layout/login.php', $data);
            }
            
        } else {
            //validasi lolos
            $this->login();
        }
    }

    private function login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $this->load->model('UserModel');
        $user = $this->UserModel->getUserLogin($username);

        //jika user ada
        if ($user) {
            //jika user aktif
            if ($user['is_active'] == 1) {
                if (md5($password) === $user['password']) {
                    // set cookie
                    if ($this->input->post('remember_me')) {
                        $this->load->helper("string");
                        $key = random_string('alnum', 64);
                        set_cookie('hellotech_eschool', $key, 3600*24*30); // set expired 30 hari kedepan
                        // simpan key di database
                        $data = array(
                            'cookie' => $key
                        );
                        $where = ['id' => $user['id']];
                        $this->load->model('GlobalModel');
                        $this->GlobalModel->updateItem($data, $where, 'user');
                    }
                    // set session
                    $data = [
                        'username' => $user['username'],
                        'user_id'  => $user['id'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 1 || $user['role_id'] == 2 || $user['role_id'] == 3) {
                        $this->session->set_userdata('file_manager',true);
                        redirect('dashboard');
                    } else {
                        redirect('profile');
                    }
                } else {
                    $this->session->set_flashdata('error', 'Username atau password salah !!');
                    if ($this->input->post('is_public')) {
                        redirect('/');
                    }else{
                        redirect('login');
                    }
                }
            } else {
                $this->session->set_flashdata('error', 'Username atau password salah !!');
                if ($this->input->post('is_public')) {
                    redirect('/');
                }else{
                    redirect('login');
                }
            }
        } else {
            $this->session->set_flashdata('error', 'Username atau password salah !!');
            if ($this->input->post('is_public')) {
                redirect('/');
            }else{
                redirect('login');
            }
        }
        
        
    }

    public function blocked()
    {
        $data['title'] = 'Page Not Access';
        $data['user']       = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $this->load->view('backend/layout/blocked', $data);
    }

    public function logout()
    {
        delete_cookie('hellotech_eschool');
        $role_id = $this->session->userdata('role_id');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('role_id');
        $this->session->unset_userdata('file_manager');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You have been logged out!</div>');
        if ($role_id == 4) {
            redirect('/');
        }else{
            redirect('login');
        }
        
    }
}
