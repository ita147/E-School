<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banner extends Base_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel');
        $this->load->model('GlobalModel');
    }

    public function index()
    {
        $data = $this->data;
        $data['title']      = 'Banner';
        // get all users
        $data['users']      = $this->UserModel->getAllUser();
        $data['results']    = $this->GlobalModel->getAppBanner();
        // set template yang kan digunakan ke view
        $this->template->load('default', 'contents', 'backend/homepage/banner/index.php', $data);
    }

    // save process
    public function save_process()
    {
        // validation form
        $this->form_validation->set_rules('text', 'deskripsi', 'trim|required');
        $this->form_validation->set_rules('name', 'Nama', 'trim|required');
        $this->form_validation->set_rules('nip', 'NIP', 'trim|required');
        $this->form_validation->set_rules('image', 'Gambar', 'trim|required');
        // validation checking
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('homepage/banner');
        } else {
            // set data for post
            $data = [
                "name"     => $this->input->post('name'),
                "nip"      => $this->input->post('nip'),
                "text"     => $this->input->post('text'),
                "image"    => $this->input->post('image')
            ];
            // call model
            if ($this->GlobalModel->updateItem($data,['id' => 1],'app_banner')) {
                $this->session->set_flashdata('success', 'Data berhasil di simpan !');  
            }else{
                $this->session->set_flashdata('error', 'Data gagal di simpan !');   
            }
            redirect('homepage/banner');
        }
    }

}
