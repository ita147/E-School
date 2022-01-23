<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProductModel extends CI_model
{

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        // load encrypt
        $this->load->library('encrypt');
        $this->db = $this->load->database('default', true);
    }

    public function getAllCategories()
    {
        $sql = "SELECT *
                FROM product_categories  WHERE deleted = 0";
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
                FROM product_categories WHERE deleted = 0 LIMIT ?, ?";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            foreach ($result as $key => $value) {
                $data = $this->get_sub_categories($value['id']);
                $result[$key]['sub_categories'] = $data;
                $result[$key]['total_sub_categories'] = count($data);
            }
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

    private function get_sub_categories($product_categories){
        $params = [$product_categories];
        $sql = "SELECT * FROM product_sub_categories psc
                WHERE psc.product_categories = ? and psc.deleted = 0
                ORDER BY id ASC";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }


    public function getAllCoupon()
    {
        $sql = "SELECT *
                FROM product_coupon  WHERE deleted = 0";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }


    public function getPagingCoupon($params)
    {
        $sql = "SELECT *
                FROM product_coupon WHERE deleted = 0 LIMIT ?, ?";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }


    public function getAllCouponActive()
    {
        $sql = "SELECT *
                FROM product_coupon WHERE date_to >= CURDATE() ";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        } 
    }

    public function getAllProduct()
    {
        $sql = "SELECT *
                FROM product  WHERE deleted = 0";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

    public function getPagingProduct($params)
    {
        $sql = "SELECT p.*, pd.name as categories_name
                FROM product p
                LEFT JOIN product_categories pd on pd.id = p.product_categories
                WHERE p.deleted = 0 LIMIT ?, ?";
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

