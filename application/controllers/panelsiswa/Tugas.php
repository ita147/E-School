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
        $config['base_url'] = base_url().'panelsiswa/tugas/index';
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
        $this->template->load('default', 'contents', 'backend/panelsiswa/tugas/index.php', $data);
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
        redirect('panelsiswa/tugas');
    }


    // edit Tugas
    public function detail_tugas($id)
    {
        $data = $this->data;
        // decripting parameters
        $id = decrypt_url($id);
        if (empty($id)) {
            $this->session->set_flashdata('error', 'Data tidak di temukan !!');
            redirect('panelsiswa/tugas');
        }
        // get detail post
        $data['title'] = 'Detail Tugas';
        $data['results']     = $this->DutyModel->getDetailTugasPub([$this->data['user']['id'],$id]);
        // set view
        $this->template->load('default', 'contents', 'backend/panelsiswa/tugas/detail.php', $data);     
    }

    // delete process
    public function download($id)
    {
        $this->load->helper('download');
        $id = decrypt_url($id);
        if (empty($id)) {
            $this->session->set_flashdata('error', 'Data tidak di temukan !!');
            redirect('panelsiswa/tugas');
        }
        $Tugas = $this->DutyModel->getDetailTugas($id);

        $data = file_get_contents(base_url('/upload/'.$Tugas['file']));
        force_download($Tugas['file'], $data);
    }

     // upload process
    public function upload_tugas_process()
    {
        // validation form
        $this->form_validation->set_rules('tugas_id', 'ID', 'required');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error', validation_errors());
            if (empty(decrypt_url($this->input->post('id')))) {
                redirect('panelsiswa/tugas');
            }
        } else {
            try {
                // check file 
                $config['upload_path'] = './upload/tugas_siswa';
                $config['allowed_types'] = 'jpeg|jpg|png|docx|doc|pdf|xls|xlsx|ppt|pptx';
                $config['max_size'] = 10240;

                // load library
                $this->load->library('upload', $config);
                if (!empty($_FILES['file']['name'])) {

                    if (!$this->upload->do_upload('file')) {
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                        redirect('panelsiswa/tugas/detail_tugas/'.encrypt_url($this->input->post('tugas_id', true)));
                    } else {
                        $data = $this->upload->data();
                        $update_res = [
                            "id_tugas"  => $this->input->post('tugas_id', true),
                            "filename"  => 'upload/tugas_siswa/'.$data['file_name'],
                            "user_id"   => $this->session->userdata('user_id'),
                            "created_at"=> date('Y-m-d H:i:s')
                        ];
                    }

                    if ($this->GlobalModel->addItem($update_res, 'file_tugas_member')) {
                        $this->session->set_flashdata('success', 'Tugas berhasil di upload !'); 
                        redirect('panelsiswa/tugas/detail_tugas/'.encrypt_url($this->input->post('tugas_id', true)));
                    }else{
                        $this->session->set_flashdata('error', 'Tugas gagal di upload !'); 
                        redirect('panelsiswa/tugas/detail_tugas/'.encrypt_url($this->input->post('tugas_id', true)));
                    }
                }else{
                    $this->session->set_flashdata('error', 'Tugas gagal di upload !'); 
                    redirect('panelsiswa/tugas/detail_tugas/'.encrypt_url($this->input->post('tugas_id', true)));
                }                
            } catch (Exception $e) {
                $this->session->set_flashdata('error', 'Tugas gagal di upload !'); 
                redirect('panelsiswa/tugas/detail_tugas/'.encrypt_url($this->input->post('tugas_id', true)));
            }
            
        }
    }

  
}
