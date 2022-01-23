<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MenuModel extends CI_model
{

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        // load encrypt
        $this->load->library('encrypt');
        $this->db = $this->load->database('default', true);
    }


    public function get_menu_by_role($id)
    {
        $sql = "SELECT app_menu.id, app_menu.url as url, app_menu.menu as name, app_menu.icon
                FROM user_access_menu 
                JOIN app_menu ON app_menu.id = user_access_menu.menu_id
                WHERE user_access_menu.role_id = ?
                GROUP BY app_menu.id
                ORDER BY app_menu.order ASC";
        $query = $this->db->query($sql, $id);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            foreach ($result as $key => $value) {
                $data = $this->get_sub_menus_base($value['id'],$id);
                $result[$key]['submenu'] = $data;
                $result[$key]['total_submenu'] = count($data);
            }
            return $result;
        } else {
            return array();
        }
    }

    private function get_sub_menus_base($menu_id, $role_id){
        $params = [$role_id, $menu_id];
        $sql = "SELECT app_sub_menu.id, app_sub_menu.url as url, app_sub_menu.name as name, app_sub_menu.icon
                FROM user_access_menu 
                JOIN app_sub_menu ON app_sub_menu.id = user_access_menu.sub_menu_id
                WHERE user_access_menu.role_id = ?
                AND user_access_menu.menu_id = ?
                ORDER BY app_sub_menu.order ASC";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }


    public function getAllMenu(){
        $sql = "SELECT am.*
                FROM app_menu am
                ORDER BY am.order ASC";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            foreach ($result as $key => $value) {
                $data = $this->get_sub_menus($value['id']);
                $result[$key]['submenu'] = $data;
                $result[$key]['total_submenu'] = count($data);
            }
            return $result;
        } else {
            return array();
        }
    }

    private function get_sub_menus($menu_id){
        $params = [$menu_id];
        $sql = "SELECT * FROM app_sub_menu  asm 
                WHERE menu_id = ?
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

    public function addMenu($data = array())
    {   
        if (empty($data)) {
            return false;
        }else{
            return $this->db->insert('app_menu', $data);
        }
    }
}

