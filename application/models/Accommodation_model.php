<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accommodation_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_accommodations($limit, $offset, $category = null, $search_query = null) {
        if ($category) {
            $this->db->where('category', $category);
        }
        if ($search_query) {
            $this->db->like('name', $search_query);
            $this->db->or_like('description', $search_query);
        }
        $this->db->limit($limit, $offset);
        $query = $this->db->get('accommodations');
        return $query->result();
    }

    public function count_all_accommodations($category = null, $search_query = null) {
        if ($category) {
            $this->db->where('category', $category);
        }
        if ($search_query) {
            $this->db->like('name', $search_query);
            $this->db->or_like('description', $search_query);
        }
        return $this->db->count_all_results('accommodations');
    }

    public function get_accommodation_by_id($id) {
        $this->db->select('accommodations.*, GROUP_CONCAT(accommodation_photos.photo SEPARATOR ",") as photos, GROUP_CONCAT(categories.name SEPARATOR ", ") as category_names');
        $this->db->from('accommodations');
        $this->db->join('accommodation_photos', 'accommodations.id = accommodation_photos.accommodation_id', 'left');
        $this->db->join('accommodations_categories', 'accommodations_categories.accommodation_id = accommodations.id', 'left');
        $this->db->join('categories', 'categories.id = accommodations_categories.category_id', 'left');
        $this->db->where('accommodations.id', $id);
        $this->db->group_by('accommodations.id');
        $query = $this->db->get();
        $result = $query->row();
        if ($result) {
            $result->photos = explode(',', $result->photos);
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
