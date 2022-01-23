<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PublicModel extends CI_model
{

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        // load encrypt
        $this->load->library('encrypt');
        $this->db = $this->load->database('default', true);
    }

    public function get_user_session_data()
    {
        $this->load->model('UserModel');
        $user = $this->UserModel->get_detail_users_by_username($this->session->userdata('username'));
        return $user;
    }

    public function get_app_setting()
    {
        $this->load->model('GlobalModel');
        return $this->GlobalModel->getAppSettings();
    }

    public function get_app_social()
    {
        $this->load->model('GlobalModel');
        return $this->GlobalModel->getAppSocial();
    }


    public function pagination_config(){
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] ="</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";

        return $config;
    }

    public function get_notification(){
        if (empty($this->session->userdata('username'))) {
            return array();
        }else{
            $sql = "SELECT pcn.*, u.name as comment_name, u.image, pc.text, pc.post_id
                FROM post_comment_notification pcn
                LEFT JOIN post_comment pc ON pcn.comment_id = pc.id
                LEFT JOIN user u on pcn.user_id_comment = u.id
                WHERE pcn.user_id = ? GROUP BY pcn.comment_id";
            $query = $this->db->query($sql, $this->session->userdata('user_id'));
            if ($query->num_rows() > 0) {
                $result = $query->result_array();
                $query->free_result();
                return $result;
            } else {
                return array();
            }
        }
    }

    public function getTestimoniByUser()
    {
        $sql = "SELECT * FROM post_testimoni WHERE user_id = ?";
        $query = $this->db->query($sql, $this->session->userdata('user_id'));
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }
}

