<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas extends Base_Controller {

	public function __construct()
    {
        parent::__construct();
        // load model here
        $this->load->model('MasterModel');
        $this->load->model('GlobalModel');
        // load library here
        $this->load->library('pagination');
    }

	public function index()
	{
		$data = $this->data;
		$data['title']      = 'Kelas';
        // setup pagination
        $config = $data['pagination_config'];
        $config['base_url'] = base_url().'master/kelas/index';
        $config['total_rows'] = count($this->MasterModel->getAllKelas());
        $config['per_page'] = 20;
        $config['uri_segment'] = 4;
        $config['from'] = $this->uri->segment(4);

        $this->pagination->initialize($config); 
        // load data
        $data['results'] = $this->MasterModel->getPagingKelas([empty($config['from']) ? 0 : intval($config['from']), $config['per_page']]);

        $numb = empty($config['from']) ? 1 : intval($config['from'])+1;
        $data["no"]   = $numb;
        $data["links"] = $this->pagination->create_links();
    
        // set template yang kan digunakan ke view
        $this->template->load('default', 'contents', 'backend/master/kelas/index.php', $data);
	}

	// add process
	public function add_process()
    {
    	// validation form
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        // validation checking
        if ($this->form_validation->run() == false) {
        	$this->session->set_flashdata('error', validation_errors());
            redirect('master/kelas');
        } else {
        	// set data for post
        	$data = [
	            "name" => $this->input->post('name', true)
	        ];
        	// call model
            if ($this->GlobalModel->addItem($data, 'master_kelas')) {
            	$this->session->set_flashdata('success', 'Kelas baru berhasil di simpan !');	
            }else{
            	$this->session->set_flashdata('error', 'Kelas gagal di simpan !');	
            }
            redirect('master/kelas');
        }
    }

    // edit process
    public function edit_process()
    {
    	// validation form
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('id', 'ID', 'trim|required');
        // validation checking
        if ($this->form_validation->run() == false) {
        	$this->session->set_flashdata('error', validation_errors());
            redirect('master/kelas');
        } else {
        	// set data for post
        	$data = [
                "name" => $this->input->post('name', true)
            ];
	        // where item
	        $where = [
	            "id" => $this->input->post('id', true)
	        ];
        	// call model
            if ($this->GlobalModel->updateItem($data, $where, 'master_kelas')) {
            	$this->session->set_flashdata('success', 'Kelas berhasil di perbarui !');	
            }else{
            	$this->session->set_flashdata('error', 'Kelas gagal di perbarui !');	
            }
            redirect('master/kelas');
        }
    }

    // delete process
    public function delete_process($id)
    {
    	// decripting parameters
    	$id = decrypt_url($id);
    	$where = ['id' => $id];
        $data = ["deleted" => 1];
    	if ($this->GlobalModel->updateItem($data, $where, 'master_kelas')) {
        	$this->session->set_flashdata('success', 'Kategori berhasil di hapus !');	
        }else{
        	$this->session->set_flashdata('error', 'Kategori gagal di hapus !');	
        }
        redirect('master/kelas');    	
    }
}
