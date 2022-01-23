<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserModel extends CI_model
{

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        // load encrypt
        $this->load->library('encrypt');
        $this->db = $this->load->database('default', true);
    }


    public function update_users($data = array(), $where)
    {
        return $this->db->update('user', $data, $where);
    }

    function get_detail_users_by_username($username)
    {

        $sql = "SELECT u.*, ur.role as role_name FROM user u
                LEFT JOIN user_role ur ON u.role_id = ur.id
                WHERE username = ?";
        $query = $this->db->query($sql, $username);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

    public function getAllUser()
    {
        $sql = "SELECT u.name, u.id FROM user u";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }


    public function getAllPengajar()
    {
        $sql = "SELECT *
                FROM user WHERE deleted = 0 and role_id = 3";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }


    public function getPagingPengajar($params)
    {
        $sql = "SELECT u.*, up.riwayat_pendidikan, up.kelas_id, up.phone
                FROM user u 
                INNER JOIN user_pengajar up ON u.id = up.user_id
                WHERE deleted = 0 AND role_id = 3 LIMIT ?, ?";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            foreach ($result as $key => $value) {
                $result[$key]['kelas'] = $this->getKelasMaster(json_decode($value['kelas_id']));
            }
            return $result;
        } else {
            return array();
        }
    }

    public function getKelasMaster($params)
    {
        if (!empty($params)) {
            $sql = "SELECT *
                FROM master_kelas WHERE id IN ? AND deleted = 0 ";
            $query = $this->db->query($sql, array($params));
            if ($query->num_rows() > 0) {
                $result = $query->result_array();
                $query->free_result();
                return $result;
            } else {
                return array();
            }
        }else{
            return array();
        }
        
    }

    public function get_detail_users_by_id($id)
    {

        $sql = "SELECT u.*, ur.role as role_name FROM user u
                LEFT JOIN user_role ur ON u.role_id = ur.id
                WHERE u.id = ?";
        $query = $this->db->query($sql, $id);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

    public function get_detail_pengajar_user_id($id)
    {

        $sql = "SELECT * FROM user_pengajar
                WHERE user_id = ?";
        $query = $this->db->query($sql, $id);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $result['kelas_id'] = json_decode($result['kelas_id']);
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

    public function get_detail_member_user_id($id)
    {

        $sql = "SELECT * FROM user_member
                WHERE user_id = ?";
        $query = $this->db->query($sql, $id);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();            
            return $result;
        } else {
            return array();
        }
    }


    public function checkusernameEdit($id, $username){
        $params = [$username, $id];
        $sql = "SELECT * FROM user
                WHERE username = ? AND id <> ?";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function checkemailEdit($id, $email){
        $params = [$email, $id];
        $sql = "SELECT * FROM user
                WHERE username = ? AND id <> ?";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function getAllMember($status, $name)
    {
        if ($status != NULL) {
            $params = [$status, $name, $name];
            $sql = "SELECT u.*
                FROM user u 
                INNER JOIN user_member um ON u.id = um.user_id
                WHERE u.deleted = 0 and u.role_id = 4 AND um.status = ? AND (u.name LIKE ? OR um.nisn LIKE ?)";
            $query = $this->db->query($sql, $params);  
        }else{
            $params = [ $name, $name];
            $sql = "SELECT u.*
                FROM user u 
                INNER JOIN user_member um ON u.id = um.user_id
                WHERE u.deleted = 0 and u.role_id = 4 AND  (u.name LIKE ? OR um.nisn LIKE ?)";
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


    public function getPagingMember($status, $name, $from, $to)
    {
        if (!empty($status != NULL)) {
            $params = [$status, $name, $name, $from, $to];
            $sql = "SELECT u.*, um.status, um.student_phone, um.alamat, um.tanggal_lahir, um.tempat_lahir, um.nisn
                FROM user u 
                INNER JOIN user_member um ON u.id = um.user_id
                WHERE u.deleted = 0 AND role_id = 4 AND um.status = ? AND (u.name LIKE ? OR um.nisn LIKE ?) ORDER BY u.name ASC LIMIT ?, ?";
            $query = $this->db->query($sql, $params);
        }else{
            $params = [$name, $name, $from, $to];
            $sql = "SELECT u.*, um.status, um.student_phone, um.alamat, um.tanggal_lahir, um.tempat_lahir, um.nisn
                FROM user u 
                INNER JOIN user_member um ON u.id = um.user_id
                WHERE u.deleted = 0 AND role_id = 4 AND (um.status <> 2 OR um.status <> 3)  AND (u.name LIKE ? OR um.nisn LIKE ?) ORDER BY u.name ASC LIMIT ?, ?";
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

    public function getUnapproveMember()
    {
        $sql = "SELECT u.*, um.nisn, um.status, um.student_phone, um.alamat, um.tanggal_lahir, um.tempat_lahir 
                FROM user u 
                INNER JOIN user_member um ON u.id = um.user_id
                WHERE role_id = 4 AND (um.status = 2 OR um.status = 3)";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

    public function getUserByRole($params)
    {
        $sql = "SELECT * FROM user WHERE role_id = ?";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

    public function getAllPengajarPub()
    {
        $sql = "SELECT u.*, up.riwayat_pendidikan, up.kelas_id, up.phone
                FROM user u 
                INNER JOIN user_pengajar up ON u.id = up.user_id
                WHERE deleted = 0 AND role_id = 3";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            foreach ($result as $key => $value) {
                $result[$key]['kelas'] = $this->getKelasMaster(json_decode($value['kelas_id']));
            }
            return $result;
        } else {
            return array();
        }
    }

    public function getUserLogin($username)
    {
        $params = array($username, $username);
        $sql = "SELECT u.* FROM user u
                WHERE (username = ? OR email = ?) AND deleted = 0 AND is_active = 1";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

    public function getAllUserAdmin()
    {
        $sql = "SELECT u.name, u.id FROM user u WHERE deleted = 0 AND role_id = 2";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

    public function getPagingUserAdmin($params)
    {
        $sql = "SELECT u.*
                FROM user u 
                WHERE u.deleted = 0 AND role_id = 2 LIMIT ?, ?";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

    public function getAlumniPub()
    {
        $sql = "SELECT u.*, um.sekolah, um.status, um.student_phone, um.alamat, pt.description as testimoni
                FROM user u 
                INNER JOIN user_member um ON u.id = um.user_id
                INNER JOIN post_testimoni pt ON pt.user_id = u.id
                WHERE u.deleted = 0 AND role_id = 4 AND um.status = 0 GROUP BY u.id";
            $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

     public function getUserByMail($params)
    {
        $sql = "SELECT * FROM user WHERE email = ?";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

     public function getAllUserSetting()
    {
        $sql = "SELECT u.name, u.id FROM user u WHERE (role_id = 1 OR role_id = 2) AND deleted = 0";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }
}
