<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Approve extends Base_Controller {

    public function __construct()
    {
        parent::__construct();
        // load model here
        $this->load->model('UserModel');
        $this->load->model('MasterModel');
        // load library here
        $this->load->library('pagination');
    }

    public function index()
    {
        $data = $this->data;
        $data['title']      = 'Persetujuan Member';
        $data['results'] = $this->UserModel->getUnapproveMember();
        // set template yang kan digunakan ke view
        $this->template->load('default', 'contents', 'backend/member/approve/index.php', $data);
    }

    // delete process
    public function approve_process($id)
    {
        // decripting parameters
        $id = decrypt_url($id);
        $member = $this->UserModel->get_detail_member_user_id($id);
        $where = ['id' => $id];
        $data = ["deleted" => 0, "is_active" => 1];
        $this->GlobalModel->updateItem($data, $where, 'user');

        $where = ['user_id' => $id];
        if ($member['status'] == 3) {
            $data = ["status" => 0];
        }else{
            $data = ["status" => 1];
        }
        
        if ($this->GlobalModel->updateItem($data, $where, 'user_member')) {
            $this->session->set_flashdata('success', 'Member telah di setujui !');   
        }else{
            $this->session->set_flashdata('error', 'Member gagal di setuji !');    
        }
        redirect('member/approve');       
    }

    public function decline_process($id)
    {
        // decripting parameters
        $id = decrypt_url($id);
        $member = $this->UserModel->get_detail_member_user_id($id);
        $user = $this->UserModel->get_detail_users_by_id($id);
        $where = ['id' => $id];
        $data = [
            "username" => $user['username'].'_deleted',
            "email" => 'deleted_'.$user['email'],
            "deleted" => 1, 
            "is_active" => 0
        ];
        $this->GlobalModel->updateItem($data, $where, 'user');

        $where = ['user_id' => $id];
        if ($member['status'] == 3) {
            $data = ["status" => 4];
        }else{
            $data = ["status" => 4];
        }
        
        if ($this->GlobalModel->updateItem($data, $where, 'user_member')) {
            $this->session->set_flashdata('success', 'Member telah di setujui !');   
        }else{
            $this->session->set_flashdata('error', 'Member gagal di setuji !');    
        }
        redirect('member/approve');       
    }
}
