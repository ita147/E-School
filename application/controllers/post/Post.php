<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends Base_Controller {
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
		$data['title']      = 'Post';
        // get search data
        $search = $this->session->userdata('post_search');
        if (!empty($search)) {
            $categories         = (!empty($search['categories'])) ? '"'.$search['categories'].'"' : '%';;
            $data['categories_sel'] = $search['categories'];
            $data['titles']     = $search['titles'];
            $title              = '%'.$search['titles'].'%';
        }else{
            $data['categories_sel'] = '';
            $data['titles']     = '';
            $title              = '%';
            $categories         = '%';
        }

         // setup pagination
        $config = $data['pagination_config'];
        $config['base_url'] = base_url().'post/post/index';
        $config['total_rows'] = count($this->PostModel->getAllPost($title, $categories));
        $config['per_page'] = 20;
        $config['uri_segment'] = 4;
        $config['from'] = $this->uri->segment(4);
        // get menus
        $this->pagination->initialize($config); 
        // load data
        $data['results'] = $this->PostModel->getPagingPost($title, $categories, empty($config['from']) ? 0 : intval($config['from']), $config['per_page']);

        $numb = empty($config['from']) ? 1 : intval($config['from'])+1;
        $data["no"]   = $numb;
        $data["links"] = $this->pagination->create_links();
         $data['categories'] = $this->PostModel->getAllCategories();
        // set template yang kan digunakan ke view
        $this->template->load('default', 'contents', 'backend/post/post/index.php', $data);
	}

     // search process
    public function search_process()
    {
        // validation form
        $this->form_validation->set_rules('categories', 'Categories', 'trim');
        $this->form_validation->set_rules('titles', 'Name', 'trim');
        // validation checking
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error', validation_errors());
        } else {
            if ($this->input->post('submit', true) == 'show') {
                $data = [
                    'categories' => $this->input->post('categories', true),
                    'titles'   => $this->input->post('titles', true)
                ];

                $this->session->set_userdata('post_search', $data);
            }else{
                $this->session->unset_userdata('post_search');
            }
        }
        redirect('post/post');
    }

    public function add_post()
    {
        $data = $this->data;
        $data['title']      = 'Tambah Post';
        // get data
        $data['categories'] = $this->PostModel->getAllCategories();
        $data['tags'] = $this->PostModel->getAllTags();
        // set template yang kan digunakan ke view
        $this->template->load('default', 'contents', 'backend/post/post/add.php', $data);
    }

	// add menu process
	public function add_process()
    {
    	// validation form
        $this->form_validation->set_rules('title', 'Judul', 'trim|required');
        $this->form_validation->set_rules('content', 'Content', 'required');
        $this->form_validation->set_rules('slug', 'Slug', 'trim|required');
        $this->form_validation->set_rules('categories[]', 'Kategori', 'trim');
        $this->form_validation->set_rules('tags[]', 'tags', 'trim');
        $this->form_validation->set_rules('meta_desc', 'tags', 'trim');
        $this->form_validation->set_rules('featured_image', 'Gambar Unggulan', 'trim');
        $this->form_validation->set_rules('is_publish', 'Tampil di publik', 'trim');
        // validation checking
        if ($this->form_validation->run() == false) {
        	$this->session->set_flashdata('error', validation_errors());
            redirect('post/post');
        } else {
        	// set data for post
        	$data = [
	            "title"             => $this->input->post('title', true),
                "content"           => $this->input->post('content'),
                "slug"              => $this->input->post('slug', true),
                "categories"        => json_encode($this->input->post('categories[]')),
                "tags"              => json_encode($this->input->post('tags[]')),
                "meta_desc"         => $this->input->post('meta_desc', true),
                "featured_image"    => $this->input->post('featured_image', true),
                "is_publish"        => ($this->input->post('is_publish', true)) == NULL ? 0 : 1,
                "created_at"        => date('Y-m-d H:i:s'),
                "updated_by"        => $this->data['user']['id'],
                "created_by"        => $this->data['user']['id'],
               
	        ];
    
        	// call model
            if ($this->GlobalModel->addItem($data, 'post_blog')) {
            	$this->session->set_flashdata('success', 'Post baru berhasil di simpan !');	
            }else{
            	$this->session->set_flashdata('error', 'Post gagal di simpan !');	
            }
            redirect('post/post');
        }
    }

     // edit page
    public function edit_post($id)
    {
        $data = $this->data;
        // decripting parameters
        $id = decrypt_url($id);
        // get detail post
        $data['title'] = 'Edit Post';
        $data['results'] = $this->PostModel->getDetailPostEdit($id);
        $data['categories'] = $this->PostModel->getAllCategories();
        $data['tags'] = $this->PostModel->getAllTags();
        // set view
        $this->template->load('default', 'contents', 'backend/post/post/edit.php', $data);     
    }

    // edit menu process
    public function edit_process()
    {
    	// validation form
        $this->form_validation->set_rules('title', 'Judul', 'trim|required');
        $this->form_validation->set_rules('content', 'Content', 'required');
        $this->form_validation->set_rules('slug', 'Slug', 'trim|required');
        $this->form_validation->set_rules('categories[]', 'Kategori', 'trim');
        $this->form_validation->set_rules('tags[]', 'tags', 'trim');
        $this->form_validation->set_rules('meta_desc', 'tags', 'trim');
        $this->form_validation->set_rules('featured_image', 'Gambar Unggulan', 'trim');
        $this->form_validation->set_rules('is_publish', 'Tampil di publik', 'trim');        
        $this->form_validation->set_rules('id', 'ID', 'trim|required');
        // validation checking
        if ($this->form_validation->run() == false) {
        	$this->session->set_flashdata('error', validation_errors());
            redirect('post/post');
        } else {
        	// set data for post
        	$data = [
                "title"             => $this->input->post('title', true),
                "content"           => $this->input->post('content'),
                "slug"              => $this->input->post('slug', true),
                "categories"        => json_encode($this->input->post('categories[]')),
                "tags"              => json_encode($this->input->post('tags[]')),
                "meta_desc"         => $this->input->post('meta_desc', true),
                "featured_image"    => $this->input->post('featured_image', true),
                "is_publish"        => ($this->input->post('is_publish', true)) == NULL ? 0 : 1,
                "updated_by"        => $this->data['user']['id'],
               
            ];
	        // where item
	        $where = ["id" => decrypt_url($this->input->post('id', true))];
        	// call model
            if ($this->GlobalModel->updateItem($data, $where, 'post_blog')) {
            	$this->session->set_flashdata('success', 'Post berhasil di perbarui !');	
            }else{
            	$this->session->set_flashdata('error', 'Post gagal di perbarui !');	
            }
            redirect('post/post');
        }
    }

    // delete process
    public function delete_process($id)
    {
    	// decripting parameters
    	$id = decrypt_url($id);
    	$where = ['id' => $id];
        $data  = ['deleted' => 1];
    	if ($this->GlobalModel->updateItem($data, $where,'post_blog')) {
        	$this->session->set_flashdata('success', 'Tags berhasil di hapus !');	
        }else{
        	$this->session->set_flashdata('error', 'Tags gagal di hapus !');	
        }
        redirect('post/post');    	
    }
}
