<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tags extends Base_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('PostModel');
        $this->load->model('GlobalModel');
        // load library here
        $this->load->library('pagination');
    }

	public function index()
	{
		$data = $this->data;
		$data['title']      = 'Tags';
        // setup pagination
        $config = $data['pagination_config'];
        $config['base_url'] = base_url().'post/tags/index';
        $config['total_rows'] = count($this->PostModel->getAlltags());
        $config['per_page'] = 20;
        $config['uri_segment'] = 4;
        $config['from'] = $this->uri->segment(4);
		// get menus
		$this->pagination->initialize($config); 
        // load data
        $data['results'] = $this->PostModel->getPagingTags([empty($config['from']) ? 0 : intval($config['from']), $config['per_page']]);

        $numb = empty($config['from']) ? 1 : intval($config['from'])+1;
        $data["no"]   = $numb;
        $data["links"] = $this->pagination->create_links();
        // set template yang kan digunakan ke view
        $this->template->load('default', 'contents', 'backend/post/tags/index.php', $data);
	}

	// add menu process
	public function add_process()
    {
    	// validation form
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        // validation checking
        if ($this->form_validation->run() == false) {
        	$this->session->set_flashdata('error', validation_errors());
            redirect('post/tags');
        } else {
        	// set data for post
        	$data = [
	            "name" => $this->input->post('name', true),
                "slug" => str_replace(" ", "_", strtolower($this->input->post('name', true))),
	        ];
        	// call model
            if ($this->GlobalModel->addItem($data, 'post_tags')) {
            	$this->session->set_flashdata('success', 'Tags baru berhasil di simpan !');	
            }else{
            	$this->session->set_flashdata('error', 'Tags gagal berhasil di simpan !');	
            }
            redirect('post/tags');
        }
    }

    // edit menu process
    public function edit_process()
    {
    	// validation form
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('id', 'ID', 'trim|required');
        // validation checking
        if ($this->form_validation->run() == false) {
        	$this->session->set_flashdata('error', validation_errors());
            redirect('post/tags');
        } else {
        	// set data for post
        	$data = [
                "name" => $this->input->post('name', true),
                "slug" => str_replace(" ", "_", strtolower($this->input->post('name', true))),
            ];
	        // where item
	        $where = [
	            "id" => $this->input->post('id', true)
	        ];
        	// call model
            if ($this->GlobalModel->updateItem($data, $where, 'post_tags')) {
            	$this->session->set_flashdata('success', 'Tags berhasil di perbarui !');	
            }else{
            	$this->session->set_flashdata('error', 'Tags gagal di perbarui !');	
            }
            redirect('post/tags');
        }
    }

    // delete process
    public function delete_process($id)
    {
    	// decripting parameters
    	$id = decrypt_url($id);
    	$where = ['id' => $id];
    	if ($this->GlobalModel->deleteItem($where, 'post_tags')) {
        	$this->session->set_flashdata('success', 'Tags berhasil di hapus !');	
        }else{
        	$this->session->set_flashdata('error', 'Tags gagal di hapus !');	
        }
        redirect('post/tags');    	
    }
}
