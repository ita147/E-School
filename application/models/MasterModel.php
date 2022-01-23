<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MasterModel extends CI_model
{

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        // load encrypt
        $this->load->library('encrypt');
        $this->db = $this->load->database('default', true);
    }

    public function getAllKelas()
    {
        $sql = "SELECT *
                FROM master_kelas WHERE deleted = 0";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

    public function getAllTahun()
    {
        $sql = "SELECT *
                FROM master_tahun_ajaran WHERE deleted = 0";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }


    public function getPagingKelas($params)
    {
        $sql = "SELECT *
                FROM master_kelas WHERE deleted = 0 LIMIT ?, ?";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

    public function getAllCategories()
    {
        $sql = "SELECT *
                FROM master_categories WHERE deleted = 0";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }


    public function getPagingCategories($params)
    {
        $sql = "SELECT *
                FROM master_categories WHERE deleted = 0 LIMIT ?, ?";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }


}

