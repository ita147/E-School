<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RoleModel extends CI_model
{

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        // load encrypt
        $this->load->library('encrypt');
        $this->db = $this->load->database('default', true);
    }

    public function getAllRole()
    {
        $sql = "SELECT ur.*
                FROM user_role ur";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }


    public function getAllAccess($id)
    {
        $sql = "SELECT am.*, IF(acm.id IS NULL, 0, 1) as is_selected
                FROM app_menu am
                LEFT JOIN user_access_menu acm ON am.id = acm.menu_id and role_id = ?
                GROUP BY am.id
                ORDER BY am.order ASC";
        $query = $this->db->query($sql, $id);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            foreach ($result as $key => $value) {
                $data = $this->get_sub_menus($value['id'], $id);
                $result[$key]['submenu'] = $data;
                $result[$key]['total_submenu'] = count($data);
            }
            return $result;
        } else {
            return array();
        }
    }

    private function get_sub_menus($menu_id, $role_id){
        $params = [$role_id, $menu_id];
        $sql = "SELECT asm.*, IF(acm.id IS NULL, 0, 1) as is_selected FROM app_sub_menu  asm 
                LEFT JOIN user_access_menu acm ON asm.id = acm.sub_menu_id and acm.role_id = ?
                WHERE asm.menu_id = ?
                ORDER BY asm.order ASC";
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

