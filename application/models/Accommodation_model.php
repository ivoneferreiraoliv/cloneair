<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accommodation_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_accommodations() {
        $query = $this->db->get('accommodations');
        return $query->result();
    }

    public function get_accommodation_by_id($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('accommodations');
        return $query->row();
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
}