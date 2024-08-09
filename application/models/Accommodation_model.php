<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accommodation_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_accommodations($limit = 0, $offset = 0, $category_id = null, $search_query = null) {
        $this->db->select('accommodations.*, GROUP_CONCAT(DISTINCT accommodation_photos.photo SEPARATOR ",") as photos, GROUP_CONCAT(DISTINCT categories.name SEPARATOR ", ") as category_names');
        $this->db->from('accommodations');
        $this->db->join('accommodation_photos', 'accommodations.id = accommodation_photos.accommodation_id', 'left');
        $this->db->join('accommodations_categories', 'accommodations_categories.accommodation_id = accommodations.id', 'left');
        $this->db->join('categories', 'categories.id = accommodations_categories.category_id', 'left');
    
        if ($category_id) {
            $this->db->where('accommodations_categories.category_id', $category_id);
        }
    
        if ($search_query) {
            $this->db->group_start();
            $this->db->like('accommodations.name', $search_query);
            $this->db->or_like('accommodations.description', $search_query);
            $this->db->group_end();
        }
    
        $this->db->group_by('accommodations.id');
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_all_accommodations($category_id = null, $search_query = null) {
        $this->db->select('COUNT(DISTINCT accommodations.id) as total');
        $this->db->from('accommodations');
        $this->db->join('accommodations_categories', 'accommodations_categories.accommodation_id = accommodations.id', 'left');
    
        if ($category_id) {
            $this->db->where('accommodations_categories.category_id', $category_id);
        }
    
        if ($search_query) {
            $this->db->group_start();
            $this->db->like('accommodations.name', $search_query);
            $this->db->or_like('accommodations.description', $search_query);
            $this->db->group_end();
        }
    
        $query = $this->db->get();
        return $query->row()->total;
    }

    public function get_accommodations_with_categories($limit, $offset, $category_id = null, $search_query = null) {
        $this->db->select('accommodations.*, GROUP_CONCAT(categories.name SEPARATOR ", ") as category_names');
        $this->db->from('accommodations');
        $this->db->join('accommodations_categories', 'accommodations.id = accommodations_categories.accommodation_id', 'left');
        $this->db->join('categories', 'accommodations_categories.category_id = categories.id', 'left');
        
        // Ajuste na cláusula WHERE para refletir a relação correta
        if ($category_id) {
            $this->db->where('categories.id', $category_id);
        }
    
        if ($search_query) {
            $this->db->like('accommodations.title', $search_query);
            $this->db->or_like('accommodations.description', $search_query);
        }
    
        $this->db->limit($limit, $offset);
        $this->db->group_by('accommodations.id');
        $query = $this->db->get();
    
        return $query->result();
    }

    public function get_accommodations_by_category($category_name) {
        $this->db->select('accommodations.*, GROUP_CONCAT(accommodation_photos.photo SEPARATOR ", ") as photos, GROUP_CONCAT(categories.name SEPARATOR ", ") as category_names');
        $this->db->from('accommodations');
        $this->db->join('accommodation_photos', 'accommodations.id = accommodation_photos.accommodation_id', 'left');
        $this->db->join('accommodations_categories', 'accommodations_categories.accommodation_id = accommodations.id', 'left');
        $this->db->join('categories', 'categories.id = accommodations_categories.category_id', 'left');
        $this->db->where('categories.name', $category_name); // Corrigido para usar a coluna 'name' da tabela 'categories'
        $this->db->group_by('accommodations.id');
        $this->db->limit(6);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_accommodation_by_id($id) {
        $this->db->select('accommodations.*, GROUP_CONCAT(DISTINCT accommodation_photos.photo SEPARATOR ",") as photos, GROUP_CONCAT(DISTINCT categories.name SEPARATOR ", ") as category_names');
        $this->db->from('accommodations');
        $this->db->join('accommodation_photos', 'accommodations.id = accommodation_photos.accommodation_id', 'left');
        $this->db->join('accommodations_categories', 'accommodations_categories.accommodation_id = accommodations.id', 'left');
        $this->db->join('categories', 'categories.id = accommodations_categories.category_id', 'left');
        $this->db->where('accommodations.id', $id);
        $this->db->group_by('accommodations.id');
        $query = $this->db->get();
        $result = $query->row();
        
        if ($result) {
            if (!empty($result->photos)) {
                // Explode the photos string into an array
                $photos = explode(',', $result->photos);
                // Remove any empty or whitespace-only strings
                $photos = array_filter($photos, function($photo) {
                    return !empty(trim($photo));
                });
                $result->photos = $photos;
            } else {
                $result->photos = [];
            }
        }
    
        return $result;
    }

    public function get_accommodations_with_photos() {
        $this->db->select('accommodations.*, accommodation_photos.photo, GROUP_CONCAT(categories.name SEPARATOR ", ") as category_names');
        $this->db->from('accommodations');
        $this->db->join('accommodation_photos', 'accommodations.id = accommodation_photos.accommodation_id', 'left');
        $this->db->join('accommodations_categories', 'accommodations_categories.accommodation_id = accommodations.id', 'left');
        $this->db->join('categories', 'categories.id = accommodations_categories.category_id', 'left');
        $this->db->group_by('accommodations.id'); 
        $query = $this->db->get();
        return $query->result();
    }

    public function create_accommodation($data) {
        $insert = $this->db->insert('accommodations', $data);
        if ($insert) {
            return true; 
        } else {
            return false; 
        }
    }

    public function update_accommodation($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('accommodations', $data);
    }

    public function delete_accommodation($id) {
        $this->db->where('id', $id);
        $result = $this->db->delete('accommodations');
        return $result; 
    }

    public function search_accommodations($query) {
        $this->db->like('name', $query);
        $this->db->or_like('description', $query);
        $this->db->or_like('location', $query);
        $query = $this->db->get('accommodations');
        return $query->result();
    }

}
