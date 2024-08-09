<?php
class Category_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }

    public function get_all_categories() {
        $query = $this->db->get('categories');
        return $query->result_array();
    }

    public function get_category_by_id($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('categories');
        return $query->row();
    }
}