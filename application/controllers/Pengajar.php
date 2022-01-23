<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengajar extends Base_Controller {

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
        $data['title']      = 'Guru';
        // setup pagination
        $config = $data['pagination_config'];
        $config['base_url'] = base_url().'master/categories/index';
        $config['total_rows'] = count($this->UserModel->getAllPengajar());
        $config['per_page'] = 20;
        $config['uri_segment'] = 4;
        $config['from'] = $this->uri->segment(4);

        $this->pagination->initialize($config); 
        // load data
        $data['results'] = $this->UserModel->getPagingPengajar([empty($config['from']) ? 0 : intval($config['from']), $config['per_page']]);

        $numb = empty($config['from']) ? 1 : intval($config['from'])+1;
        $data["no"]   = $numb;
        $data["links"] = $this->pagination->create_links();
        // set template yang kan digunakan ke view
        $this->template->load('default', 'contents', 'backend/pengajar/index.php', $data);
    }

    public function add_pengajar()
    {
        $data = $this->data;
        $data['title']      = 'Tambah Guru';
        // get data
        $data['kelas'] = $this->MasterModel->getAllKelas();
        // set template yang kan digunakan ke view
        $this->template->load('default', 'contents', 'backend/pengajar/add.php', $data);
    }

    // add process
    public function add_process()
    {
        // validation form
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('image', 'Foto', 'trim');
        $this->form_validation->set_rules('riwayat_pendidikan', 'Riwayat Pendidikan', 'trim');
        $this->form_validation->set_rules('phone', 'Nomor Telepon', 'trim');
        $this->form_validation->set_rules('kelas_id[]', 'Kelas id', 'trim');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[user.username]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[user.email]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('is_active', 'Status', 'trim|required');
        // validation checking
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error', validation_errors());
            $data = $this->data;
            $data['title']      = 'Tambah Guru';
            // get data
            $data['kelas'] = $this->MasterModel->getAllKelas();
            $this->template->load('default', 'contents', 'backend/pengajar/add.php', $data);
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
                    "role_id"   => 3,
                ];
                // call model
                if ($this->GlobalModel->addItem($data, 'user')) {
                    $user_id = $this->GlobalModel->lastID();
                    // set data for detail pengajar
                    $data = [
                        'riwayat_pendidikan'    => $this->input->post('riwayat_pendidikan', true),
                        'phone'                 => $this->input->post('phone', true),
                        'kelas_id'              => json_encode($this->input->post('kelas_id[]')),
                        'user_id'               => $user_id,
                    ];
                    $this->GlobalModel->addItem($data, 'user_pengajar');
                    $this->session->set_flashdata('success', 'Data Pengajar baru berhasil di simpan !');    
                }else{
                    $this->session->set_flashdata('error', 'Data Guru gagal di simpan !'); 
                }
                // redirect 
                redirect('pengajar');
            } catch (Exception $e) {
                $this->session->set_flashdata('error', 'Data Guru gagal di simpan !'); 
                $data = $this->data;
                $data['title']      = 'Tambah Guru';
                // get data
                $data['kelas'] = $this->MasterModel->getAllKelas();
                $this->template->load('default', 'contents', 'backend/pengajar/add.php', $data);
            }
            
        }
    }

    public function edit_pengajar($id)
    {
        $data = $this->data;
        $data['title']      = 'Ubah Guru';
        // get data
        $data['kelas'] = $this->MasterModel->getAllKelas();
        // get detail user 
        $id = decrypt_url($id);
        $data['detail']     = $this->UserModel->get_detail_users_by_id($id);
        $data['pengajar'] = $this->UserModel->get_detail_pengajar_user_id($id);
        // set template yang kan digunakan ke view
        $this->template->load('default', 'contents', 'backend/pengajar/edit.php', $data);
    }

    // edit process
    public function edit_process()
    {
        // validation form
        $this->form_validation->set_rules('id', 'ID', 'required');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('image', 'Foto', 'trim');
        $this->form_validation->set_rules('riwayat_pendidikan', 'Riwayat Pendidikan', 'trim');
        $this->form_validation->set_rules('phone', 'Nomor Telepon', 'trim');
        $this->form_validation->set_rules('kelas_id[]', 'Kelas id', 'trim');
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim');
        $this->form_validation->set_rules('is_active', 'Status', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error', validation_errors());
            if (empty(decrypt_url($this->input->post('id')))) {
                redirect('pengajar/edit_pengajar/'.$this->input->post('id'));
            }else{
                redirect('pengajar/');
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
                    redirect('pengajar/edit_pengajar/'.$this->input->post('id'));
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
                        "role_id"   => 3,
                    ];  
                }else{
                    $data = [
                        "name"      => $this->input->post('name', true),
                        "username"  => $this->input->post('username', true),
                        "is_active"    => $this->input->post('is_active', true),
                        "image"     => $this->input->post('image', true),
                        "email"     => $this->input->post('email', true),
                        "role_id"   => 3,
                    ]; 
                }

                $where = ['id' => $id];
                $user_res = $this->GlobalModel->updateItem($data, $where, 'user');
                $user_id = $id;
                // set data for detail pengajar
                $data = [
                    'riwayat_pendidikan'    => $this->input->post('riwayat_pendidikan', true),
                    'phone'                 => $this->input->post('phone', true),
                    'kelas_id'              => json_encode($this->input->post('kelas_id[]')),
                ];
                $where = ['user_id' => $id];
                $data_res = $this->GlobalModel->updateItem($data,$where, 'user_pengajar');
                
                // call model
                if ($user_res || $data_res) {
                    $this->session->set_flashdata('success', 'Data Guru baru berhasil di simpan !');    
                }else{
                    $this->session->set_flashdata('error', 'Data Guru gagal di simpan !'); 
                }
                // redirect 
                redirect('pengajar');
            } catch (Exception $e) {
                $this->session->set_flashdata('error', 'Data Guru gagal di simpan !'); 
                redirect('pengajar/edit_pengajar/'.$this->input->post('id'));
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
            $this->session->set_flashdata('success', 'Data Pengajar berhasil di hapus !');   
        }else{
            $this->session->set_flashdata('error', 'Data Pengajar  gagal di hapus !');    
        }
        redirect('pengajar');       
    }
}
