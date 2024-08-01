<?php
class Category_model extends CI_Model {
    public function get_categories() {
        $query = $this->db->get('categories');
        return $query->result_array();
    }
}
