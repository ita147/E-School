<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
    {
        parent::__construct();
        $this->load->model('PublicModel');
        $this->load->model('PostModel');
        $this->load->model('GlobalModel');
        $this->load->helper('text');
        $this->load->library('pagination');
    	$this->init();
    }

    private function init(){
    	$this->data['user'] = $this->PublicModel->get_user_session_data();
        $this->data['app_setting'] = $this->PublicModel->get_app_setting();
        $this->data['app_info'] = $this->PublicModel->get_app_social();
        $this->data['pagination_config'] = $this->PublicModel->pagination_config();
        // $this->data['notification'] = $this->PublicModel->get_notification();
    }


	public function index()
	{
		$data = $this->data;
		$data['title'] = 'Blog';
		$search = $this->input->get('search');
		if (empty($search)) {
			$search = '%';
		}else{
			$search = '%'.$search.'%';
		}
         // setup pagination
        $config = $data['pagination_config'];
        $config['base_url'] = base_url().'blog/';
        $config['total_rows'] = count($this->PostModel->getAllPostPub($search));
        if ($search == '%') {
			$config['per_page'] = 9;
		}else{
			$config['per_page'] = 1000;
		}
        
        $config['uri_segment'] = 2;
        $config['from'] = $this->uri->segment(2);
        // get menus
        $this->pagination->initialize($config); 
        // load data
        $data['results'] = $this->PostModel->getPagingPostPub([$search, empty($config['from']) ? 0 : intval($config['from']), $config['per_page']]);
        $data["links"] = $this->pagination->create_links();
        $data['categories'] = $this->PostModel->getAllCategories();
        $data['tags'] = $this->PostModel->getAllTags();
		// get other data
		$this->public_template->load('default', 'contents', 'frontend/blog/index.php', $data);
		
	}

	// edit page
    public function detail($id, $slug)
    {
    	$data = $this->data;
        $data['title'] = 'Blog';
        // get detail post
        $data['results'] = $this->PostModel->getDetailPost($id);
        $data['categories'] = $this->PostModel->getAllCategories();
        $data['tags'] = $this->PostModel->getAllTags();
        $data['title'] = $data['results']['title'];

        if (empty($data['results'])) {
        	redirect('error404','refresh');
        }
    
        // load categories
        $data['categories'] = $this->PostModel->getAllCategories();
        // set view
        $this->public_template->load('default', 'contents', 'frontend/blog/detail.php', $data);   
    }


    // edit page
    public function tags($slug)
    {
    	$data = $this->data;
        // get detail post
        $data['results'] = $this->PostModel->getPostByTag($slug);
        $data['categories'] = $this->PostModel->getAllCategories();
        $data['tags'] = $this->PostModel->getAllTags();
        $data["links"] = '';
        // set view
        $this->public_template->load('default', 'contents', 'frontend/blog/index.php', $data);   
    }

     // edit page
    public function categories($slug)
    {
    	$data = $this->data;
        // get detail post
        $data['results'] = $this->PostModel->getPostByCat($slug);
        $data['categories'] = $this->PostModel->getAllCategories();
        $data['tags'] = $this->PostModel->getAllTags();
        $data["links"] = '';
        // set view
        $this->public_template->load('default', 'contents', 'frontend/blog/index.php', $data);   
    }

    // save comment
    public function save_comment()
    {
        // check login
        if (empty($this->session->userdata('username'))) {
            redirect('/');
        }
        // validation
        $this->form_validation->set_rules('post_id', 'ID', 'trim|required');
        $this->form_validation->set_rules('slug', 'SLUG', 'trim|required');
        $this->form_validation->set_rules('text', 'Komentar', 'trim|required');
        // check validation
        if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('error', validation_errors()); 
            redirect('blog/detail/'.$this->input->post('post_id').'/'.$this->input->post('slug'),'refresh'); 
        }else{
            // get user id 
            $user_id = $this->session->userdata('user_id');
            $data = [
                'user_id' => $user_id,
                'post_id' => $this->input->post('post_id'),
                'text' => $this->input->post('text', true),
                'created_at' => date('Y-m-d H:i:s')
            ];
            // insert into db
            if ($this->GlobalModel->addItem($data, 'post_comment')) {
                $this->session->set_flashdata('success', "Komentar telah di post !!"); 
                redirect('blog/detail/'.$this->input->post('post_id').'/'.$this->input->post('slug'),'refresh');  
            }else{
                $this->session->set_flashdata('error', "Komentar gagal disimpan !!"); 
                redirect('blog/detail/'.$this->input->post('post_id').'/'.$this->input->post('slug'),'refresh'); 
            }

        }
    }

    // delete comment
    public function delete_com($id, $post_id)
    {
        // get detail post
        $post = $this->PostModel->getDetailPost($post_id);
        $where = ['id' => $id];
        if ($this->GlobalModel->deleteItem($where, 'post_comment')) {
            $this->session->set_flashdata('success', 'Komentar di hapus !');   
        }else{
            $this->session->set_flashdata('error', 'Komentar gagal di hapus !');    
        }
        // set view
        redirect('blog/detail/'.$post_id.'/'.$post['slug'],'refresh');  
    }


    // save comment
    public function save_reply()
    {
        // check login
        if (empty($this->session->userdata('username'))) {
            redirect('/');
        }
        // validation
        $this->form_validation->set_rules('post_id', 'ID', 'trim|required');
        $this->form_validation->set_rules('slug', 'SLUG', 'trim|required');
        $this->form_validation->set_rules('text', 'Balasan', 'trim|required');
        $this->form_validation->set_rules('comment_id', 'Komentar', 'trim|required');
        $this->form_validation->set_rules('page_id', 'Pages', 'trim');
        // check validation
        if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('error', validation_errors()); 
            redirect('blog/detail/'.$this->input->post('post_id').'/'.$this->input->post('slug').'/'.$this->input->post('page_id'),'refresh'); 
        }else{
            // get user id 
            $user_id = $this->session->userdata('user_id');
            $data = [
                'user_id' => $user_id,
                'comment_id' => $this->input->post('comment_id'),
                'text' => $this->input->post('text', true),
                'created_at' => date('Y-m-d H:i:s')
            ];
            // insert into db
            if ($this->GlobalModel->addItem($data, 'post_comment_reply')) {
                // sent notification
                $all_user_on_reply = $this->PostModel->getAllUserRep($this->session->userdata('user_id'), $this->input->post('comment_id'));
                $detail_com = $this->PostModel->getDetailCom($this->input->post('comment_id'));
                if (!empty($all_user_on_reply['email'])) {
                    $view['results'] = $detail_com;
                    $view['user']  = $this->PublicModel->get_user_session_data();
                    $view['setting'] = $this->GlobalModel->getAppSettings();
                    $view['contact'] = $this->GlobalModel->getAppSocial();
                    $view['post_id'] = $this->input->post('post_id');
                    $view['slug']    = $this->input->post('slug');
                    $html = $this->load->view('email/post_notification', $view, true);
                    // sent notification
                    $this->load->helper('notification');
                    send_notification($all_user_on_reply['email'], 'Notifikasi Komentar', $html);   
                }
                // post notificaton
                if (!empty($all_user_on_reply['user_id'])) {
                    $data = [];
                    foreach ($all_user_on_reply['user_id'] as $value) {
                        $data[] = [
                            'comment_id'        => $this->input->post('comment_id'),
                            'user_id'           => $value,
                            'user_id_comment'   => $this->session->userdata('user_id')
                        ];
                    }
                    $this->GlobalModel->addItemBatch($data, 'post_comment_notification');
                }
                // done
                $this->session->set_flashdata('success', "Komentar telah di post !!"); 
                redirect('blog/detail/'.$this->input->post('post_id').'/'.$this->input->post('slug').'/'.$this->input->post('page_id'),'refresh');   
            }else{
                $this->session->set_flashdata('error', "Komentar gagal disimpan !!"); 
                redirect('blog/detail/'.$this->input->post('post_id').'/'.$this->input->post('slug').'/'.$this->input->post('page_id'),'refresh');  
            }

        }
    }


    //delete reply
     public function delete_rep($id, $post_id, $page_id)
    {
        // get detail post
        $post = $this->PostModel->getDetailPost($post_id);
        $where = ['id' => $id];
        if ($this->GlobalModel->deleteItem($where, 'post_comment_reply')) {
            $this->session->set_flashdata('success', 'Komentar di hapus !');   
        }else{
            $this->session->set_flashdata('error', 'Komentar gagal di hapus !');    
        }
        // set view
        redirect('blog/detail/'.$post_id.'/'.$post['slug'].'/'.$page_id,'refresh');  
    }

}
