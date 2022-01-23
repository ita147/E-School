<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends Base_Controller {

    public function __construct()
    {
        parent::__construct();
        // load model here
        $this->load->model('UserModel');
        $this->load->model('MasterModel');
        // load library here
        $this->load->library('pagination');
    }

    public function index()
    {
        $data = $this->data;
        $data['title']      = 'Siswa';
        // get search data
        $search = $this->session->userdata('member_search');
        if (!empty($search)) {
            $data['status'] = $search['status'];
            $data['name'] = $search['name'];
            $name = '%'.$search['name'].'%';
        }else{
            $data['status'] = '';
            $data['name'] = '';
            $name = '%';
        }
        // setup pagination
        $config = $data['pagination_config'];
        $config['base_url'] = base_url().'member/member/index';
        $config['total_rows'] = count($this->UserModel->getAllMember($data['status'], $name));
        $config['per_page'] = 20;
        $config['uri_segment'] = 4;
        $config['from'] = $this->uri->segment(4);

        $this->pagination->initialize($config); 
        // load data
        $data['results'] = $this->UserModel->getPagingMember($data['status'], $name, empty($config['from']) ? 0 : intval($config['from']), $config['per_page']);

        $numb = empty($config['from']) ? 1 : intval($config['from'])+1;
        $data["no"]   = $numb;
        $data["links"] = $this->pagination->create_links();
        // set template yang kan digunakan ke view
        $this->template->load('default', 'contents', 'backend/member/member/index.php', $data);
    }

    // search process
    public function search_process()
    {
        // validation form
        $this->form_validation->set_rules('status', 'Status', 'trim');
        $this->form_validation->set_rules('name', 'Name', 'trim');
        // validation checking
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error', validation_errors());
        } else {
            if ($this->input->post('submit', true) == 'show') {
                $data = [
                'status' => $this->input->post('status', true),
                'name'   => $this->input->post('name', true)
            ];

                $this->session->set_userdata('member_search', $data);
            }else{
                $this->session->unset_userdata('member_search');
            }
        }
        redirect('member/member');
    }

    public function add_member()
    {
        $data = $this->data;
        $data['title']      = 'Tambah Siswa';
        $this->template->load('default', 'contents', 'backend/member/member/add.php', $data);
    }

    // add process
    public function add_process()
    {
        // validation form
        $this->form_validation->set_rules('name', 'Nama', 'trim|required');
        $this->form_validation->set_rules('nisn', 'Nama Panggilan', 'trim|required');
        $this->form_validation->set_rules('image', 'Foto', 'trim');
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
        $this->form_validation->set_rules('student_phone', 'Nomor Telepon', 'trim|required');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'trim|required');
        $this->form_validation->set_rules('tempat_lahir', 'Tanggal Lahir', 'trim|required');
        $this->form_validation->set_rules('status', 'Status Siswa', 'trim|required');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[user.username]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[user.email]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('is_active', 'Status', 'trim|required');
        // validation checking
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error', validation_errors());
            $data = $this->data;
            $data['title']      = 'Tambah Siswa';
            $this->template->load('default', 'contents', 'backend/member/member/add.php', $data);
        } else {
            try {
                // set data for post
                $data = [
                    "name"      => $this->input->post('name', true),
                    "username"  => $this->input->post('username', true),
                    "password"  => md5($this->input->post('password', true)),
                    "is_active"    => $this->input->post('is_active', true),
                    "image"     => $this->input->post('image', true),
                    "email"     => $this->input->post('email', true),
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
                        'status'        => $this->input->post('status', true),
                        'user_id'       => $user_id,
                    ];
                    $this->GlobalModel->addItem($data, 'user_member');
                    $this->session->set_flashdata('success', 'Data Siswa baru berhasil di simpan !');    
                }else{
                    $this->session->set_flashdata('error', 'Data Siswa gagal di simpan !'); 
                }
                // redirect 
                redirect('member/member');
            } catch (Exception $e) {
                $this->session->set_flashdata('error', 'Data Siswa gagal di simpan !'); 
                $data = $this->data;
                $data['title']      = 'Tambah Siswa';
                $this->template->load('default', 'contents', 'backend/member/member/add.php', $data);
            }
            
        }
    }

    public function edit_member($id)
    {
        $data = $this->data;
        $data['title']      = 'Ubah Member';
        $id = decrypt_url($id);
        $data['detail']     = $this->UserModel->get_detail_users_by_id($id);
        $data['member'] = $this->UserModel->get_detail_member_user_id($id);
        // set template yang kan digunakan ke view
        $this->template->load('default', 'contents', 'backend/member/member/edit.php', $data);
    }

    // edit process
    public function edit_process()
    {
        // validation form
        $this->form_validation->set_rules('id', 'IDs', 'trim|required');
        $this->form_validation->set_rules('name', 'Nama', 'trim|required');
        $this->form_validation->set_rules('nisn', 'Nama Panggilan', 'trim|required');
        $this->form_validation->set_rules('image', 'Foto', 'trim');
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
        $this->form_validation->set_rules('student_phone', 'Nomor Telepon', 'trim|required');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'trim|required');
        $this->form_validation->set_rules('tempat_lahir', 'Tanggal Lahir', 'trim|required');
        $this->form_validation->set_rules('status', 'Status Siswa', 'trim|required');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|required');
        $this->form_validation->set_rules('email', 'Email', 'trim');
        $this->form_validation->set_rules('password', 'Password', 'trim');
        $this->form_validation->set_rules('is_active', 'Status', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error', validation_errors());
            if (empty(decrypt_url($this->input->post('id')))) {
                redirect('member/member/edit_member/'.$this->input->post('id'));
            }else{
                redirect('member/member');
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
                    redirect('member/member/edit_member/'.$this->input->post('id'));
                }
                // set data for post
                if (!empty($this->input->post('password'))) {
                    $data = [
                        "name"      => $this->input->post('name', true),
                        "username"  => $this->input->post('username', true),
                        "password"  => md5($this->input->post('password', true)),
                        "is_active"    => $this->input->post('is_active', true),
                        "image"     => $this->input->post('image', true),
                        "email"     => $this->input->post('email', true),
                        "role_id"   => 4,
                    ];  
                }else{
                    $data = [
                        "name"      => $this->input->post('name', true),
                        "username"  => $this->input->post('username', true),
                        "is_active"    => $this->input->post('is_active', true),
                        "image"     => $this->input->post('image', true),
                        "email"     => $this->input->post('email', true),
                        "role_id"   => 4,
                    ]; 
                }

                $where = ['id' => $id];
                $user_res = $this->GlobalModel->updateItem($data, $where, 'user');
                $user_id = $id;
                // set data for detail pengajar
                $data = [
                        'nisn'  => $this->input->post('nisn', true),
                        'tempat_lahir'  => $this->input->post('tempat_lahir', true),
                        'tanggal_lahir' => $this->input->post('tanggal_lahir', true),
                        'alamat'        => $this->input->post('alamat', true),
                        'student_phone' => $this->input->post('student_phone', true),
                        'status'        => $this->input->post('status', true)
                    ];
                $where = ['user_id' => $id];
                $data_res = $this->GlobalModel->updateItem($data,$where, 'user_member');
                
                // call model
                if ($user_res || $data_res) {
                    $this->session->set_flashdata('success', 'Data Siswa baru berhasil di simpan !');    
                }else{
                    $this->session->set_flashdata('error', 'Data Siswa gagal di simpan !'); 
                }
                // redirect 
                redirect('member/member');
            } catch (Exception $e) {
                $this->session->set_flashdata('error', 'Data Siswa gagal di simpan !'); 
                redirect('member/member/edit_member/'.$this->input->post('id'));
            }
            
        }
    }


    // delete process
    public function delete_process($id)
    {
        // decripting parameters
        $id = decrypt_url($id);
        $user     = $this->UserModel->get_detail_users_by_id($id);
        $where = ['id' => $id];
        $data = [
            "username" => $user['username'].'_deleted',
            "email" => 'deleted_'.$user['email'],
            "deleted" => 1, 
            "is_active" => 0
        ];

        if ($this->GlobalModel->updateItem($data, $where, 'user')) {
            $this->session->set_flashdata('success', 'Data Siswa berhasil di hapus !');   
        }else{
            $this->session->set_flashdata('error', 'Data Siswa  gagal di hapus !');    
        }
        redirect('member/member');       
    }
}
