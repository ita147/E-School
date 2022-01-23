<?php
defined('BASEPATH') or exit('No direct script access allowed');

class GlobalModel extends CI_model
{

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        // load encrypt
        $this->load->library('encrypt');
        $this->db = $this->load->database('default', true);
    }

    public function addItem($data = array(), $table = '')
    {   
        if (empty($data)) {
            return false;
        }else{
            return $this->db->insert($table, $data);
        }
    }

     public function getAppBanner()
    {
        $sql = "SELECT * FROM app_banner WHERE id = 1";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

    public function addItemBatch($data = array(), $table = '')
    {   
        if (empty($data)) {
            return false;
        }else{
            return $this->db->insert_batch($table, $data);
        }
    }

    public function updateItem($data = array(), $where = array(), $table = '')
    {   
        if (empty($data)) {
            return false;
        }else{
            return $this->db->update($table, $data, $where);
        }
    }

    public function deleteItem($where = array(), $table = '')
    {   
        if (empty($where)) {
            return false;
        }else{
            return $this->db->delete($table, $where);
        }
    }

    public function getAppSettings()
    {
        $sql = "SELECT * FROM app_setting WHERE id = 1";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            $result['mail_notification_list'] = unserialize($result['mail_notification_list']);
            $result['phone_notification_list'] = unserialize($result['phone_notification_list']);
            return $result;
        } else {
            return array();
        }
    }

    public function getAppApi()
    {
        $sql = "SELECT * FROM app_api WHERE id = 1";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }


    public function checkEditValueDeleted($table,$field,$data,$id)
    {
        $params = [$field,$data,$id];
        $sql = "SELECT * FROM ".$table." WHERE ? = ? AND id <> ? AND deleted = 0";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function lastID(){
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }

    public function getAppPages()
    {
        $sql = "SELECT * FROM app_pages WHERE id = 1";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

    public function getAppSocial()
    {
        $sql = "SELECT * FROM app_social WHERE id = 1";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

    public function getAppHarga()
    {
        $sql = "SELECT * FROM home_price WHERE id = 1";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }
}

