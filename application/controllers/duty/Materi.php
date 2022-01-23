<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Materi extends Base_Controller {

    public function __construct()
    {
        parent::__construct();
        // load model here
        $this->load->model('DutyModel');
        $this->load->model('GlobalModel');
        $this->load->model('MasterModel');
        // load library here
        $this->load->library('pagination');
    }

    public function index()
    {
        $data = $this->data;
        $data['title']      = 'Materi';
        // get data 
        $data['categories']      = $this->MasterModel->getAllCategories();
        // get search data
        $search = $this->session->userdata('materi_search');
        if (!empty($search)) {
            $data['categories_id'] = $search['categories_ids'];
            $data['title_materi'] = $search['title_materi'];
            $title = '%'.$search['title_materi'].'%';
        }else{
            $data['categories_id'] = '';
            $data['title_materi'] = '';
            $title = '%';
        }
        // setup pagination
        $config = $data['pagination_config'];
        $config['base_url'] = base_url().'duty/materi/index';
        $config['total_rows'] = count($this->DutyModel->getAllMateri($title, $data['categories_id']));
        $config['per_page'] = 20;
        $config['uri_segment'] = 4;
        $config['from'] = $this->uri->segment(4);

        $this->pagination->initialize($config); 
        // load data
        $data['results'] = $this->DutyModel->getPagingMateri($title, $data['categories_id'], empty($config['from']) ? 0 : intval($config['from']), $config['per_page']);

        $numb = empty($config['from']) ? 1 : intval($config['from'])+1;
        $data["no"]   = $numb;
        $data["links"] = $this->pagination->create_links();
    
        // set template yang kan digunakan ke view
        $this->template->load('default', 'contents', 'backend/duty/materi/index.php', $data);
    }

    // search process
    public function search_process()
    {
        // validation form
        $this->form_validation->set_rules('categories_ids', 'Kategori', 'trim');
        $this->form_validation->set_rules('title_materi', 'Title', 'trim');
        $this->form_validation->set_rules('title_materi', 'Title', 'trim');
        // validation checking
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error', validation_errors());
        } else {
            if ($this->input->post('submit', true) == 'show') {
                $data = [
                'categories_ids' => $this->input->post('categories_ids', true),
                'title_materi' => $this->input->post('title_materi', true)
            ];

                $this->session->set_userdata('materi_search', $data);
            }else{
                $this->session->unset_userdata('materi_search');
            }
        }
        redirect('duty/materi');
    }

    public function add_materi()
    {
        $data = $this->data;
        $data['title']      = 'Tambah Materi';
        $data['categories']      = $this->MasterModel->getAllCategories();
        // set template yang kan digunakan ke view
        $this->template->load('default', 'contents', 'backend/duty/materi/add.php', $data);
    }

    // add menu process
    public function add_process()
    {
        // validation form
        $this->form_validation->set_rules('title', 'Judul', 'trim|required');
        $this->form_validation->set_rules('description', 'Deskripsi', 'trim');
        $this->form_validation->set_rules('file', 'File Materi', 'required');
        $this->form_validation->set_rules('is_publish', 'Status', 'trim');
        $this->form_validation->set_rules('type', 'Status', 'trim|required');
        $this->form_validation->set_rules('categories_id', 'Kategori', 'trim|required');
        // validation checking
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error', validation_errors());
            $data = $this->data;
            $data['categories']      = $this->MasterModel->getAllCategories();
            $data['title']      = 'Tambah Materi';
            // set template yang kan digunakan ke view
            $this->template->load('default', 'contents', 'backend/duty/materi/add.php', $data);
        } else {
            // set data for post
            $data = [
                "title"         => $this->input->post('title', true),
                "description"   => $this->input->post('description', true),
                "file"          => $this->input->post('file'),
                "is_publish"    => $this->input->post('is_publish'),
                "type"          => $this->input->post('type'),
                "categories_id" => $this->input->post('categories_id'),
                "upload_by"     => $this->data['user']['id']
            ];
            // call model
            if ($this->GlobalModel->addItem($data, 'file_materi')) {
                $this->session->set_flashdata('success', 'Materi baru berhasil di simpan !');   
                redirect('duty/materi');
            }else{
                $this->session->set_flashdata('error', 'Materi gagal di simpan !'); 
                $data = $this->data;
                $data['title']      = 'Tambah Materi';
                $data['categories']      = $this->MasterModel->getAllCategories();
                // set template yang kan digunakan ke view
                $this->template->load('default', 'contents', 'backend/duty/materi/add.php', $data);
            }
        }
    }

    // edit materi
    public function edit_materi($id)
    {
        $data = $this->data;
        // decripting parameters
        $id = decrypt_url($id);
        if (empty($id)) {
            $this->session->set_flashdata('error', 'Data tidak di temukan !!');
            redirect('duty/materi');
        }
        // get detail post
        $data['title'] = 'Edit Materi';
        $data['results']     = $this->DutyModel->getDetailMateri($id);
        $data['categories']  = $this->MasterModel->getAllCategories();
        // set view
        $this->template->load('default', 'contents', 'backend/duty/materi/edit.php', $data);     
    }

    // edit menu process
    public function edit_process()
    {
        // validation form
        $this->form_validation->set_rules('id', 'ID', 'required');
        $this->form_validation->set_rules('title', 'Judul', 'trim|required');
        $this->form_validation->set_rules('description', 'Deskripsi', 'trim');
        $this->form_validation->set_rules('file', 'File Materi', 'required');
        $this->form_validation->set_rules('is_publish', 'Status', 'trim');
        $this->form_validation->set_rules('type', 'type', 'trim|required');
        $this->form_validation->set_rules('categories_id', 'Kategori', 'trim|required');
        // validation checking
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error', validation_errors());
            if (empty(decrypt_url($this->input->post('id')))) {
                redirect('duty/materi/edit_materi/'.$this->input->post('id'));
            }else{
                redirect('duty/materi');
            }
        } else {
            // validation checking
            $id = decrypt_url($this->input->post('id'));
            if (empty($id)) {
                $this->session->set_flashdata('error', 'Data tidak di temukan !!');
                redirect('duty/materi');
            }
            // set data for post
            $data = [
                "title"         => $this->input->post('title', true),
                "description"   => $this->input->post('description', true),
                "file"          => $this->input->post('file'),
                "is_publish"    => $this->input->post('is_publish'),
                "type"          => $this->input->post('type'),
                "categories_id" => $this->input->post('categories_id'),
            ];
            // where item
            $where = [
                "id" => $id
            ];
            // call model
            if ($this->GlobalModel->updateItem($data, $where, 'file_materi')) {
                $this->session->set_flashdata('success', 'Materi berhasil di perbarui !');  
            }else{
                $this->session->set_flashdata('error', 'Materi gagal di perbarui !');   
            }
            redirect('duty/materi');
        }
    }

    // delete process
    public function delete_process($id)
    {
        // decripting parameters
        $id = decrypt_url($id);
        $where = ['id' => $id];
        if ($this->GlobalModel->deleteItem($where, 'file_materi')) {
            $this->session->set_flashdata('success', 'Materi berhasil di hapus !'); 
        }else{
            $this->session->set_flashdata('error', 'Materi gagal di hapus !');  
        }
        redirect('duty/materi');        
    }

    // delete process
    public function download($id)
    {
        $this->load->helper('download');
        $id = decrypt_url($id);
        if (empty($id)) {
            $this->session->set_flashdata('error', 'Data tidak di temukan !!');
            redirect('duty/materi');
        }
        $materi = $this->DutyModel->getDetailMateri($id);

        $data = file_get_contents(base_url('/upload/'.$materi['file']));
        force_download($materi['file'], $data);
       
    }

     // detail materi
    public function detail_materi($id)
    {
        $data = $this->data;
        // decripting parameters
        $id = decrypt_url($id);
        if (empty($id)) {
            $this->session->set_flashdata('error', 'Data tidak di temukan !!');
            redirect('duty/materi');
        }
        // get detail post
        $data['title'] = 'Detail Materi';
        $data['results']     = $this->DutyModel->getDetailMateri($id);
        // set view
        $this->template->load('default', 'contents', 'backend/duty/materi/detail.php', $data);     
    }
}
