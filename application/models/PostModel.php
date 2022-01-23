<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PostModel extends CI_model
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
                FROM post_categories";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

    public function getAllTags()
    {
        $sql = "SELECT *
                FROM post_tags";
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
                FROM post_categories LIMIT ?, ?";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

    public function getPagingTags($params)
    {
        $sql = "SELECT *
                FROM post_tags LIMIT ?, ?";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }


    public function getAllPost($title, $categories)
    {
        $params = [$title];
        $sql    = "SELECT *
            FROM post_blog pb WHERE pb.categories LIKE '%".$categories."%' AND pb.title LIKE ? AND  deleted = 0";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

    public function getPagingPost($title, $categories, $from, $to)
    {
        $params = [$title, $from, $to];
        $sql = "SELECT pb.*, u.name
                FROM post_blog pb
                LEFT JOIN user u ON pb.created_by = u.id 
                WHERE pb.title LIKE ? AND pb.categories LIKE '%".$categories."%' AND pb.deleted = 0
                LIMIT ?, ?";
            $query = $this->db->query($sql, $params);
        
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            foreach ($result as $key => $value) {
                $result[$key]['categories'] = $this->getCategoriesBlog(json_decode($value['categories']));
                $result[$key]['tags'] = $this->getTagsBlog(json_decode($value['tags']));
            }
            return $result;
        } else {
            return array();
        }
    }


    public function getCategoriesBlog($params)
    {
        if (!empty($params)) {
            $sql = "SELECT *
                FROM post_categories WHERE id IN ?";
            $query = $this->db->query($sql, array($params));
            if ($query->num_rows() > 0) {
                $result = $query->result_array();
                $query->free_result();
                $results = [];
                foreach ($result as $key => $value) {
                    $results[$value['id']] = $value;
                }
                return $results;
            } else {
                return array();
            }
        }else{
            return array();
        }
        
    }

     public function getTagsBlog($params)
    {
        if (!empty($params)) {
            $sql = "SELECT *
                    FROM post_tags WHERE id IN ?";
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

    public function getDetailPost($params)
    {
        $sql = "SELECT pb.*, u.name
                FROM post_blog pb
                LEFT JOIN user u ON pb.created_by = u.id 
                WHERE pb.deleted = 0
                AND pb.id = ?";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            $result['categories'] = $this->getCategoriesBlog(json_decode($result['categories']));
            $result['tags'] = $this->getTagsBlog(json_decode($result['tags']));
            
            return $result;
        } else {
            return array();
        }
    }

    public function getDetailPostEdit($params)
    {
        $sql = "SELECT pb.*, u.name
                FROM post_blog pb
                LEFT JOIN user u ON pb.created_by = u.id 
                WHERE pb.deleted = 0
                AND pb.id = ?";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            $result['categories'] = json_decode($result['categories']);
            $result['tags'] = json_decode($result['tags']);
            
            return $result;
        } else {
            return array();
        }
    }

    public function getAllGaleriPost()
    {
        $sql = "SELECT *
                FROM post_gallery";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

    public function getPagingGaleriPost($params)
    {
        $sql = "SELECT * 
                FROM post_gallery 
                LIMIT ?, ?";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

    public function getDetailGaleriPost($id)
    {
        $sql = "SELECT * 
                FROM post_gallery 
                WHERE id = ?";
        $query = $this->db->query($sql, $id);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

    public function getAllGaleriHome()
    {
        $sql = "SELECT *
                FROM home_gallery";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

    public function getPagingGaleriHome($params)
    {
        $sql = "SELECT * 
                FROM home_gallery 
                LIMIT ?, ?";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

    public function getDetailGaleriHome($id)
    {
        $sql = "SELECT * 
                FROM home_gallery 
                WHERE id = ?";
        $query = $this->db->query($sql, $id);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }


    public function getAllTestimoni()
    {
        $sql = "SELECT t.*, u.image, u.name
                FROM post_testimoni t
                LEFT JOIN user u ON t.user_id = u.id WHERE t.is_publish = 1";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

    public function getPagingTestimoni($params)
    {
        $sql = "SELECT p.*, u.name as user 
                FROM post_testimoni p
                LEFT JOIN user u ON p.user_id = u.id
                LIMIT ?, ?";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

    public function getAllPostLimit($params)
    {
        $sql = "SELECT pb.*, u.name
                FROM post_blog pb
                LEFT JOIN user u ON pb.created_by = u.id 
                WHERE pb.deleted = 0 AND pb.is_publish = 1 AND pb.id <> ?
                ORDER BY pb.id DESC
                LIMIT ?";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            foreach ($result as $key => $value) {
                $result[$key]['categories'] = $this->getCategoriesBlog(json_decode($value['categories']));
                $result[$key]['tags'] = $this->getTagsBlog(json_decode($value['tags']));
            }
            return $result;
        } else {
            return array();
        }
    }

    public function getLastPostLimit()
    {
        $sql = "SELECT pb.*, u.name
                FROM post_blog pb
                LEFT JOIN user u ON pb.created_by = u.id 
                WHERE pb.deleted = 0 AND pb.is_publish = 1
                ORDER BY pb.id DESC
                LIMIT 1";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

    public function getAllPostPub($search)
    {
        $sql = "SELECT *
                FROM post_blog WHERE deleted = 0 AND is_publish = 1 AND title LIKE ? ORDER BY id DESC";
        $query = $this->db->query($sql, $search);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

    public function getPagingPostPub($params)
    {
        $sql = "SELECT pb.*, u.name
                FROM post_blog pb
                LEFT JOIN user u ON pb.created_by = u.id 
                WHERE pb.deleted = 0 AND pb.is_publish = 1 AND title LIKE ?
                ORDER BY pb.id DESC
                LIMIT ?, ?";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            foreach ($result as $key => $value) {
                $result[$key]['categories'] = $this->getCategoriesBlog(json_decode($value['categories']));
                $result[$key]['tags'] = $this->getTagsBlog(json_decode($value['tags']));
            }
            return $result;
        } else {
            return array();
        }
    }

    public function getPostByTag($slug)
    {
        // get tag by slug
        $sql = "SELECT *
                FROM post_tags WHERE slug = ?";
        $query = $this->db->query($sql, $slug);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            $tags_id = $result['id'];
            // get all post by tag id
            $id = '"'.$tags_id.'"';
            $sql = "SELECT * FROM post_blog WHERE tags LIKE '%".$id."%'";
            $query = $this->db->query($sql);
            if ($query->num_rows() > 0) {
                $result = $query->result_array();
                $query->free_result();
                return $result;
            }else{
                return array();
            }
        } else {
            return array();
        }
    }

    public function getPostByCat($slug)
    {
        // get tag by slug
        $sql = "SELECT *
                FROM post_categories WHERE slug = ?";
        $query = $this->db->query($sql, $slug);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            $tags_id = $result['id'];
            // get all post by tag id
            $id = '"'.$tags_id.'"';
            $sql = "SELECT * FROM post_blog WHERE categories LIKE '%".$id."%' AND deleted <> 1";
            $query = $this->db->query($sql);
            if ($query->num_rows() > 0) {
                $result = $query->result_array();
                $query->free_result();
                return $result;
            }else{
                return array();
            }
        } else {
            return array();
        }
    }

  



}

