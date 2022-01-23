<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DutyModel extends CI_model
{

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        // load encrypt
        $this->load->library('encrypt');
        $this->db = $this->load->database('default', true);
    }

    public function getAllMateri($title, $id)
    {   
        if (!empty($id)) {
            $params = [$title,$id];
            $sql = "SELECT fm.*
                FROM file_materi fm
                LEFT JOIN master_categories mc ON fm.categories_id = mc.id
                WHERE mc.deleted = 0 AND fm.title LIKE ? AND mc.id = ?";
            $query = $this->db->query($sql, $params);    
        }else{
            $sql = "SELECT fm.*
                FROM file_materi fm
                LEFT JOIN master_categories mc ON fm.categories_id = mc.id
                WHERE mc.deleted = 0 AND fm.title LIKE ?";
            $query = $this->db->query($sql, $title);
        }
        
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }


    public function getPagingMateri($title, $id, $from, $to)
    {
        if (!empty($id)) {
            $params = [$title, $id, $from, $to];
            $sql = "SELECT fm.*, mc.name as categories_name, u.name as uploader
                FROM file_materi fm
                LEFT JOIN master_categories mc ON fm.categories_id = mc.id 
                LEFT JOIN user u ON fm.upload_by = u.id 
                WHERE mc.deleted = 0 AND fm.title LIKE ? AND mc.id = ?
                LIMIT ?, ?";
            $query = $this->db->query($sql, $params);
        }else{
            $params = [$title, $from, $to];
            $sql = "SELECT fm.*, mc.name as categories_name, u.name as uploader
                FROM file_materi fm
                LEFT JOIN master_categories mc ON fm.categories_id = mc.id 
                LEFT JOIN user u ON fm.upload_by = u.id 
                WHERE mc.deleted = 0 AND fm.title LIKE ?
                LIMIT ?, ?";
            $query = $this->db->query($sql, $params);
        }   
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

    public function getDetailMateri($params)
    {
        $sql = "SELECT fm.*, mc.name as categories_name FROM file_materi fm
                LEFT JOIN master_categories mc ON fm.categories_id = mc.id 
                WHERE fm.id = ?";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }


    public function getAllTugas($id)
    {
        if (!empty($id)) {
            $sql = "SELECT ft.*
                FROM file_tugas ft
                LEFT JOIN master_categories mc ON ft.categories_id = mc.id
                WHERE mc.deleted = 0 AND mc.id = ? AND ft.deleted = 0";
            $query = $this->db->query($sql, $id);    
        }else{
            $sql = "SELECT ft.*
                FROM file_tugas ft
                LEFT JOIN master_categories mc ON ft.categories_id = mc.id
                WHERE mc.deleted = 0 AND ft.deleted = 0";
            $query = $this->db->query($sql);
        }
        
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }


    public function getPagingTugas($id, $from, $to)
    {
        if (!empty($id)) {
            $params = [$id, $from, $to];
            $sql = "SELECT ft.*, mc.name as categories_name, u.name as creator
                FROM file_tugas ft
                LEFT JOIN master_categories mc ON ft.categories_id = mc.id 
                LEFT JOIN user u ON ft.created_by = u.id 
                WHERE mc.deleted = 0 AND ft.deleted = 0 AND mc.id = ?
                LIMIT ?, ?";
            $query = $this->db->query($sql, $params);
        }else{
            $params = [$from, $to];
            $sql = "SELECT ft.*, mc.name as categories_name, u.name as creator
                FROM file_tugas ft
                LEFT JOIN master_categories mc ON ft.categories_id = mc.id 
                LEFT JOIN user u ON ft.created_by = u.id 
                WHERE mc.deleted = 0 AND ft.deleted = 0
                LIMIT ?, ?";
            $query = $this->db->query($sql, $params);
        }   
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

    public function getDetailTugas($params)
    {
        $sql = "SELECT * FROM file_tugas
                WHERE id = ?";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

     public function getDetailTugasPub($params)
    {
        $sql = "SELECT ft.* , ftm.id as status_tugas, mc.name as categories_name FROM file_tugas ft
                LEFT JOIN file_tugas_member ftm on ft.id = ftm.id_tugas AND ftm.user_id = ?
                LEFT JOIN master_categories mc ON ft.categories_id = mc.id 
                WHERE ft.id = ?";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

     public function getDetailTugasMember($params)
    {
        $sql = "SELECT * FROM file_tugas_member
                WHERE id = ?";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

    public function getAllTugasPub($id)
    {
        $sql = "SELECT ft.*, mc.name as categories_name, u.name as creator, ftm.id as status_tugas
                FROM file_tugas ft
                LEFT JOIN master_categories mc ON ft.categories_id = mc.id 
                LEFT JOIN file_tugas_member ftm on ft.id = ftm.id_tugas AND ftm.user_id = ?
                LEFT JOIN user u ON ft.created_by = u.id 
                WHERE mc.deleted = 0 AND ft.deleted = 0";
        $query = $this->db->query($sql, $id);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

    public function getHistoryTugasPub($id)
    {
        $sql = "SELECT ft.*, mc.name as categories_name, ftm.filename AS tugas_file, u.name as creator, ftm.created_at, ftm.id as tugas_member_id FROM file_tugas ft
                INNER JOIN file_tugas_member ftm on ft.id = ftm.id_tugas
                LEFT JOIN master_categories mc ON ft.categories_id = mc.id 
                LEFT JOIN user u ON ft.created_by = u.id 
                WHERE ftm.user_id = ? AND ft.deleted = 0";
        $query = $this->db->query($sql, $id);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    } 


    public function getHistoryTugasBack($id)
    {
        $sql = "SELECT ft.*, mc.name as categories_name, ftm.filename AS tugas_file, u.name as creator, ftm.created_at, ftm.id as tugas_member_id FROM file_tugas ft
                INNER JOIN file_tugas_member ftm on ft.id = ftm.id_tugas
                LEFT JOIN master_categories mc ON ft.categories_id = mc.id 
                LEFT JOIN user u ON ftm.user_id = u.id 
                WHERE ftm.id_tugas = ? AND ft.deleted = 0";
        $query = $this->db->query($sql, $id);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

}

