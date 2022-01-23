<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Galeri extends Base_Controller {

    public function __construct()
    {
        parent::__construct();
        // load model here
        $this->load->model('PostModel');
        $this->load->model('GlobalModel');
        // load library here
        $this->load->library('pagination');
    }

    public function index()
    {
        $data = $this->data;
        $data['title']      = 'Slider';
        // setup pagination
        $config = $data['pagination_config'];
        $config['base_url'] = base_url().'master/categories/index';
        $config['total_rows'] = count($this->PostModel->getAllGaleriHome());
        $config['per_page'] = 20;
        $config['uri_segment'] = 4;
        $config['from'] = $this->uri->segment(4);

        $this->pagination->initialize($config); 
        // load data
        $data['results'] = $this->PostModel->getPagingGaleriHome([empty($config['from']) ? 0 : intval($config['from']), $config['per_page']]);

        $numb = empty($config['from']) ? 1 : intval($config['from'])+1;
        $data["no"]   = $numb;
        $data["links"] = $this->pagination->create_links();
        // set template yang kan digunakan ke view
        $this->template->load('default', 'contents', 'backend/homepage/galeri/index.php', $data);
    }

    public function add_galeri()
    {
        $data = $this->data;
        $data['title']      = 'Tambah Slider';
        // set template yang kan digunakan ke view
        $this->template->load('default', 'contents', 'backend/homepage/galeri/add.php', $data);
    }

    // add process
    public function add_process()
    {
        // validation form
        $this->form_validation->set_rules('title', 'Judul', 'trim|required');
        $this->form_validation->set_rules('description', 'Deskripsi', 'trim');
        $this->form_validation->set_rules('image', 'Foto', 'trim|required');
        $this->form_validation->set_rules('text_color', 'Warna Text', 'trim');
        // validation checking
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error', validation_errors());
            $data = $this->data;
            $data['title']      = 'Tambah Slider';
            // set template yang kan digunakan ke view
            $this->template->load('default', 'contents', 'backend/homepage/galeri/add.php', $data);
        } else {
            // set data for post
            $data = [
                "title"         => $this->input->post('title', true),
                "description"   => $this->input->post('description', true),
                "image"         => $this->input->post('image', true),
                "text_color"    => $this->input->post('text_color', true),
            ];
            // call model
            if ($this->GlobalModel->addItem($data, 'home_gallery')) {
                $this->session->set_flashdata('success', 'Slider baru berhasil di simpan !');    
            }else{
                $this->session->set_flashdata('error', 'Slider gagal di simpan !'); 
            }
            redirect('homepage/galeri');
        }
    }

    // edit process
    public function edit_process()
    {
        // validation form
        $this->form_validation->set_rules('id', 'IDs', 'trim|required');
        $this->form_validation->set_rules('title', 'Judul', 'trim|required');
        $this->form_validation->set_rules('description', 'Deskripsi', 'trim');
        $this->form_validation->set_rules('image', 'Foto', 'trim|required');
        $this->form_validation->set_rules('text_color', 'Warna Text', 'trim');
        // validation checking
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('homepage/galeri/'.$this->input->post('id'));
        } else {
            $id = decrypt_url($this->input->post('id'));
            // set data for post
            $data = [
                "title"         => $this->input->post('title', true),
                "description"   => $this->input->post('description', true),
                "image"         => $this->input->post('image', true),
                "text_color"    => $this->input->post('text_color', true),
            ];
            // where item
            $where = [
                "id" => $id
            ];
            // call model
            if ($this->GlobalModel->updateItem($data, $where, 'home_gallery')) {
                $this->session->set_flashdata('success', 'Slider berhasil di perbarui !');   
            }else{
                $this->session->set_flashdata('error', 'Slider gagal di perbarui !');    
            }
            redirect('homepage/galeri');
        }
    }

    // edit page
    public function edit_galeri($id)
    {
        $data = $this->data;
        // decripting parameters
        $id = decrypt_url($id);
        // get detail post
        $data['title'] = 'Edit Slider';
        $data['results'] = $this->PostModel->getDetailGaleriHome($id);
        // set view
        $this->template->load('default', 'contents', 'backend/homepage/galeri/edit.php', $data);     
    }

    // delete process
    public function delete_process($id)
    {
        // decripting parameters
        $id = decrypt_url($id);
        $where = ['id' => $id];
        if ($this->GlobalModel->deleteItem($where, 'home_gallery')) {
            $this->session->set_flashdata('success', 'Slider berhasil di hapus !');   
        }else{
            $this->session->set_flashdata('error', 'Slider gagal di hapus !');    
        }
        redirect('homepage/galeri');       
    }
}
