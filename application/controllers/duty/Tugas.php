<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tugas extends Base_Controller {

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
        $data['title']      = 'Tugas';
        // get data 
        $data['categories']      = $this->MasterModel->getAllCategories();
        // get search data
        $search = $this->session->userdata('tugas_search');
        if ($search) {
            $data['categories_id'] = $search;
        }else{
            $data['categories_id'] = '';
        }
        // setup pagination
        $config = $data['pagination_config'];
        $config['base_url'] = base_url().'duty/tugas/index';
        $config['total_rows'] = count($this->DutyModel->getAllTugas($data['categories_id']));
        $config['per_page'] = 20;
        $config['uri_segment'] = 4;
        $config['from'] = $this->uri->segment(4);

        $this->pagination->initialize($config); 
        // load data
        $data['results'] = $this->DutyModel->getPagingTugas($data['categories_id'], empty($config['from']) ? 0 : intval($config['from']), $config['per_page']);

        $numb = empty($config['from']) ? 1 : intval($config['from'])+1;
        $data["no"]   = $numb;
        $data["links"] = $this->pagination->create_links();
    
        // set template yang kan digunakan ke view
        $this->template->load('default', 'contents', 'backend/duty/tugas/index.php', $data);
    }

    // add menu process
    public function search_process()
    {
        // validation form
        $this->form_validation->set_rules('categories_ids', 'Kategori', 'trim');
        // validation checking
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error', validation_errors());
        } else {
            if ($this->input->post('submit', true) == 'show') {
                $categories_ids = $this->input->post('categories_ids', true);
                $this->session->set_userdata('tugas_search', $categories_ids);
            }else{
                $this->session->unset_userdata('tugas_search');
            }
        }
        redirect('duty/tugas');
    }

    public function add_tugas()
    {
        $data = $this->data;
        $data['title']      = 'Tambah Tugas';
        $data['categories']      = $this->MasterModel->getAllCategories();
        // set template yang kan digunakan ke view
        $this->template->load('default', 'contents', 'backend/duty/tugas/add.php', $data);
    }

    // add menu process
    public function add_process()
    {
        // validation form
        $this->form_validation->set_rules('title', 'Judul', 'trim|required');
        $this->form_validation->set_rules('description', 'Deskripsi', 'trim');
        $this->form_validation->set_rules('file', 'File Tugas', 'trim');
        $this->form_validation->set_rules('max_upload', 'Max Upload', 'trim|required');
        $this->form_validation->set_rules('categories_id', 'Kategori', 'trim|required');
        // validation checking
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error', validation_errors());
            $data = $this->data;
            $data['categories']      = $this->MasterModel->getAllCategories();
            $data['title']      = 'Tambah Tugas';
            // set template yang kan digunakan ke view
            $this->template->load('default', 'contents', 'backend/duty/tugas/add.php', $data);
        } else {
            // set data for post
            $data = [
                "title"         => $this->input->post('title', true),
                "description"   => $this->input->post('description', true),
                "file"          => $this->input->post('file'),
                "max_upload"    => $this->input->post('max_upload'),
                "categories_id" => $this->input->post('categories_id'),
                "created_by"    => $this->data['user']['id']
            ];
            // call model
            if ($this->GlobalModel->addItem($data, 'file_tugas')) {
                $this->session->set_flashdata('success', 'Tugas baru berhasil di simpan !');    
                redirect('duty/tugas');
            }else{
                $this->session->set_flashdata('error', 'Tugas gagal di simpan !');  
                $data = $this->data;
                $data['title']      = 'Tambah Tugas';
                $data['categories']      = $this->MasterModel->getAllCategories();
                // set template yang kan digunakan ke view
                $this->template->load('default', 'contents', 'backend/duty/tugas/add.php', $data);
            }
        }
    }

    // edit Tugas
    public function edit_tugas($id)
    {
        $data = $this->data;
        // decripting parameters
        $id = decrypt_url($id);
        if (empty($id)) {
            $this->session->set_flashdata('error', 'Data tidak di temukan !!');
            redirect('duty/tugas');
        }
        // get detail post
        $data['title'] = 'Edit Tugas';
        $data['results']     = $this->DutyModel->getDetailTugas($id);
        $data['categories']  = $this->MasterModel->getAllCategories();
        // set view
        $this->template->load('default', 'contents', 'backend/duty/tugas/edit.php', $data);     
    }

    // edit menu process
    public function edit_process()
    {
        // validation form
        $this->form_validation->set_rules('id', 'ID', 'required');
        $this->form_validation->set_rules('title', 'Judul', 'trim|required');
        $this->form_validation->set_rules('description', 'Deskripsi', 'trim');
        $this->form_validation->set_rules('file', 'File Tugas', 'trim');
        $this->form_validation->set_rules('max_upload', 'Status', 'trim|required');
        $this->form_validation->set_rules('categories_id', 'Kategori', 'trim|required');
        // validation checking
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error', validation_errors());
            if (empty(decrypt_url($this->input->post('id')))) {
                redirect('duty/tugas/edit_tugas/'.$this->input->post('id'));
            }else{
                redirect('duty/tugas');
            }
        } else {
            // validation checking
            $id = decrypt_url($this->input->post('id'));
            if (empty($id)) {
                $this->session->set_flashdata('error', 'Data tidak di temukan !!');
                redirect('duty/tugas');
            }
            // set data for post
            $data = [
                "title"         => $this->input->post('title', true),
                "description"   => $this->input->post('description', true),
                "file"          => $this->input->post('file'),
                "max_upload"    => $this->input->post('max_upload'),
                "categories_id" => $this->input->post('categories_id'),
            ];
            // where item
            $where = [
                "id" => $id
            ];
            // call model
            if ($this->GlobalModel->updateItem($data, $where, 'file_tugas')) {
                $this->session->set_flashdata('success', 'Tugas berhasil di perbarui !');   
            }else{
                $this->session->set_flashdata('error', 'Tugas gagal di perbarui !');    
            }
            redirect('duty/tugas');
        }
    }

    // delete process
    public function delete_process($id)
    {
        // decripting parameters
        $id = decrypt_url($id);
        $where = ['id' => $id];
        $data = ['deleted' => 1];
        if ($this->GlobalModel->updateItem($data, $where, 'file_tugas')) {
            $this->session->set_flashdata('success', 'Tugas berhasil di hapus !');  
        }else{
            $this->session->set_flashdata('error', 'Tugas gagal di hapus !');   
        }
        redirect('duty/tugas');     
    }

    // delete process
    public function download($id)
    {
        $this->load->helper('download');
        $id = decrypt_url($id);
        if (empty($id)) {
            $this->session->set_flashdata('error', 'Data tidak di temukan !!');
            redirect('duty/tugas');
        }
        $Tugas = $this->DutyModel->getDetailTugas($id);

        $data = file_get_contents(base_url('/upload/'.$Tugas['file']));
        force_download($Tugas['file'], $data);
       
    }

     // edit Tugas
    public function siswa_tugas($id)
    {
        $data = $this->data;
        // decripting parameters
        $id = decrypt_url($id);
        if (empty($id)) {
            $this->session->set_flashdata('error', 'Data tidak di temukan !!');
            redirect('duty/tugas');
        }
        // get detail post
        $data['title'] = 'Siswa Upload Tugas';
        $data['detail']     = $this->DutyModel->getDetailTugas($id);
        $data['results'] = $this->DutyModel->getHistoryTugasBack($id);
        // set view
        $this->template->load('default', 'contents', 'backend/duty/tugas/siswa.php', $data);     
    }

     // delete process
    public function download_tugas_siswa($id)
    {
        $this->load->helper('download');
        $id = decrypt_url($id);
        if (empty($id)) {
            $this->session->set_flashdata('error', 'Data tidak di temukan !!');
            redirect('duty/tugas/siswa_tugas/'.$id);
        }
        $materi = $this->DutyModel->getDetailTugasMember($id);

        $data = file_get_contents(base_url('/upload/'.$materi['filename']));
        force_download($materi['filename'], $data);
       
    }
}
