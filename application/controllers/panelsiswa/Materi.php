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
        $config['base_url'] = base_url().'panelsiswa/materi/index';
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
        $this->template->load('default', 'contents', 'backend/panelsiswa/materi/index.php', $data);
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
        redirect('panelsiswa/materi');
    }



    // detail materi
    public function detail_materi($id)
    {
        $data = $this->data;
        // decripting parameters
        $id = decrypt_url($id);
        if (empty($id)) {
            $this->session->set_flashdata('error', 'Data tidak di temukan !!');
            redirect('panelsiswa/materi');
        }
        // get detail post
        $data['title'] = 'Detail Materi';
        $data['results']     = $this->DutyModel->getDetailMateri($id);
        // set view
        $this->template->load('default', 'contents', 'backend/panelsiswa/materi/detail.php', $data);     
    }

    // delete process
    public function download($id)
    {
        $this->load->helper('download');
        $id = decrypt_url($id);
        if (empty($id)) {
            $this->session->set_flashdata('error', 'Data tidak di temukan !!');
            redirect('panelsiswa/materi');
        }
        $materi = $this->DutyModel->getDetailMateri($id);

        $data = file_get_contents(base_url('/upload/'.$materi['file']));
        force_download($materi['file'], $data);
       
    }
}
